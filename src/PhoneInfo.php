<?php


namespace PhoneLib;


use Exception;
use GuzzleHttp\Client;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class PhoneInfo
 * @package PhoneLib
 */
class PhoneInfo
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PDO
     */
    private $db;

    /**
     * @var PhoneNumberUtil|null
     */
    private $libphonenumber;

    /**
     * @var array
     */
    private $defaultOptions = [
        'logger' => null,
        'db_type' => self::DB_SQLITE3,
        'db_path' => __DIR__.'/../storage/default.sqlite',
        'libphonenumber' => false,
        'dadata' => false,
    ];

    private $sources = [
        "https://www.rossvyaz.ru/docs/articles/Kody_ABC-3kh.csv",
        "https://www.rossvyaz.ru/docs/articles/Kody_ABC-4kh.csv",
        "https://www.rossvyaz.ru/docs/articles/Kody_ABC-8kh.csv",
        "https://www.rossvyaz.ru/docs/articles/Kody_DEF-9kh.csv",
    ];

    /**
     * @var bool
     */
    private $prepared = false;

    /**
     * @var Client
     */
    private $guzzle;

    /**
     * @var bool
     */
    private $dadata = false;

    const DB_SQLITE3 = 'sqlite3';

    public function __construct(array $options = [])
    {
        $this->generateOptions($options);

        /**
         * Logger
         */
        $this->initLogger();

        /**
         * Database
         */
        $this->initDatabase();

        /**
         * Utils
         */
        if ($this->options['libphonenumber']) {
            switch ($this->options['libphonenumber']) {
                case true:
                    $this->libphonenumber = PhoneNumberUtil::getInstance();
                    break;
                case $this->options['libphonenumber'] instanceof PhoneNumberUtil:
                    $this->libphonenumber = $this->options['libphonenumber'];
                    break;
                case false:
                    break;
                default:
                    throw new Exception('libphonenumber initial error');
            }
        }
        if (
            is_array($this->options['dadata']) &&
            !empty($this->options['dadata']['api_key']) &&
            !empty($this->options['dadata']['secret'])
        ) {
            $this->dadata = true;
        }

        $this->guzzle = new Client([
            'timeout'  => 2.0,
        ]);
    }

    private function initLogger()
    {
        if ($this->options['logger']) {
            $this->logger = $this->options['logger'];
        } else {
            $this->logger = new NullLogger();
        }
    }

    private function initDatabase()
    {
        if ($this->options['db_type'] === self::DB_SQLITE3) {
            if (!file_exists($this->options['db_path'])) {
                file_put_contents($this->options['db_path'], '');
            }

            $this->logger->debug(
                sprintf('Using database [%s], location: %s', $this->options['db_type'], $this->options['db_path'])
            );

            try {
                $this->db = new PDO(sprintf('sqlite:%s', $this->options['db_path']));
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $this->logger->emergency($e->getMessage());
                throw $e;
            }
        } else {
            $this->logger->emergency('Wrong db type');
            throw new Exception('Wrong db type');
        }
    }

    private function generateOptions(array $options)
    {
        $this->options = array_merge($this->defaultOptions, $options);
    }

    private function prepare()
    {
        if ($this->prepared) {
            return;
        }

        if ($this->options['db_type'] === self::DB_SQLITE3) {
            $tables = $this->db->query('select * from sqlite_master where type = \'table\'')->fetchAll();
            $needTables = ['regions', 'operators', 'data'];
            foreach ($tables as $tableData) {
                $pos = array_search($tableData['tbl_name'], $needTables);
                if ($pos !== false) {
                    unset($needTables[$pos]);
                }
            }

            if (count($needTables)) {
                throw new Exception('Need to update database');
            }
        }

        $this->prepared = true;
    }

    /**
     * @param string $digits
     * @param string $region
     *
     * @return SearchResult
     */
    public function search(string $digits, string $region = 'RU'): SearchResult
    {
        try {
            $this->prepare();
        } catch (Exception $e) {
            $result = new SearchResult();
            $result->setCode(-2)
                   ->setErr($e->getMessage());

            return $result;
        }

        $this->logger->debug('Ищем '.$digits, [
            'libphonenumber' => ! is_null($this->libphonenumber)
        ]);

        switch (true) {
            case $this->libphonenumber !== null:
                try {
                    $phoneData = $this->libphonenumber->parse($digits, $region);
                    $phone = $phoneData->getCountryCode() . $phoneData->getNationalNumber();
                } catch (Exception $e) {
                    $result = new SearchResult();
                    $result->setCode(-1)
                           ->setErr('LibPhoneNumber: '.$e->getMessage());

                    return $result;
                }
                break;

            default:
                $number = preg_replace("/^\+/", '', $digits);
                if (!preg_match("/^(7|8)([0-9]{10})$/", $number, $regs)) {
                    $result = new SearchResult();
                    $result->setCode(-1)
                           ->setErr('Неверный формат номера');

                    return $result;
                }
                $phone = '7'.$regs[2];
                break;
        }

        $query = 'select data.code, data.number_min, data.number_max, region_id, operator_id, operator from data, regions, operators '.
            'where data.region_id = regions.id and data.operator_id = operators.id and '.$phone.' between number_min and number_max';
        $st = $this->db->query($query);

        $data = $st->fetch();
        if (! $data) {
            $result = new SearchResult();
            $result->setCode(-3)
                   ->setErr('Ничего не найдено');

            return $result;
        }

        $data = array_merge(['phone' => $phone], $data);

        /**
         * add region data
         */
        $st = $this->db->prepare('select type, data from region_data where region_id = ?');
        $st->execute([$data['region_id']]);
        $data['region'] = $st->fetchAll(PDO::FETCH_KEY_PAIR);

        return $this->formatDataToResult($data);
    }

    public function update()
    {
        $this->logger->info('Обновление базы данных');

        $queries = [
            'drop table if exists regions_tmp',
            'drop table if exists operators_tmp',
            'drop table if exists data_tmp',
            'create table regions_tmp (id INTEGER, region TEXT)',
            'create table operators_tmp (id INTEGER, operator TEXT)',
            'create table data_tmp ('.
                'code INTEGER, '.
                'number_min INTEGER, '.
                'number_max INTEGER, '.
                'number_count INTEGER, '.
                'operator_id INTEGER, '.
                'region_id INTEGER'.
            ')',
            'create table if not exists region_data ('.
                'region_id integer,'.
                'type text,'.
                'data text,'.
                'constraint region_data_pk primary key (region_id, type)'.
            ');',
        ];
        foreach ($queries as $query) {
            $this->db->query($query);
        }

        $regions = $this->db->query('select region, id from regions')->fetchAll(PDO::FETCH_KEY_PAIR);
        $operators = $this->db->query('select operator, id from operators')->fetchAll(PDO::FETCH_KEY_PAIR);

        if ($this->dadata) {
            $this->updateRegionData($regions);
        }

        $this->db->query("begin");

        foreach ($this->sources as $url) {
            $this->logger->debug('Updating: '.$url);

            $insCount = 0;
            $fp = fopen($url, "r");
            if ($fp) {
                while (!feof($fp)) {
                    $rowData = fgetcsv($fp, 0, ';');
                    $code = trim($rowData[0]);
                    if ($code) {
                        $from = trim($rowData[1]);
                        $to = trim($rowData[2]);
                        $count = trim($rowData[3]);
                        $operatorName = trim($rowData[4]);
                        $regionData = mb_convert_encoding(trim($rowData[5]), 'UTF-8');
                        $regionName = json_encode(explode('|', $regionData), JSON_UNESCAPED_UNICODE);

                        /**
                         * Регионы
                         */
                        if (empty($regions[$regionName])) {
                            $regions[$regionName] = count($regions) + 1;
                        }
                        $regionId = $regions[$regionName];

                        /**
                         * Оператор
                         */
                        if (empty($operators[$operatorName])) {
                            $operators[$operatorName] = count($operators) + 1;
                        }
                        $operatorId = $operators[$operatorName];


                        $st = $this->db->prepare(
                            'insert into data_tmp (code, number_min, number_max, number_count, operator_id, region_id) '.
                            'values (?, ?, ?, ?, ?, ?)'
                        );
                        $st->execute([
                            $code,
                            '7'.$code.$from,
                            '7'.$code.$to,
                            $count,
                            $operatorId,
                            $regionId,
                        ]);
                        $insCount++;
                    }
                }

                $this->logger->debug('Вставлено '.$insCount.' записей');
            } else {
                $this->logger->error('Невозможно получить данные из '.$url);
                continue;
            }
        }

        foreach ($operators as $operatorName => $id) {
            $st = $this->db->prepare('insert into operators_tmp (id, operator) values (:id, :operator)');
            $st->execute([
                'id' => $id,
                'operator' => $operatorName,
            ]);
        }

        foreach ($regions as $regionName => $id) {
            $st = $this->db->prepare('insert into regions_tmp (id, region) values (:id, :region)');
            $st->execute([
                'id' => $id,
                'region' => $regionName,
            ]);
        }

        $this->db->query("end");
        $queries = [
            'drop table if exists data',
            'drop table if exists regions',
            'drop table if exists operators',

            'ALTER TABLE data_tmp rename to data',
            'ALTER TABLE operators_tmp rename to operators',
            'ALTER TABLE regions_tmp rename to regions',

            'CREATE INDEX data_idx ON data(number_min, number_max)',
            'CREATE INDEX operators_idx ON operators(id)',
            'CREATE INDEX regions_idx ON regions(id)',
        ];

        foreach ($queries as $query) {
            $this->db->query($query);
        }
    }

    private function updateRegionData(array $regions)
    {
        /**
         * Region data
         */
        foreach ($regions as $regionName => $regionId) {
            $region = json_decode($regionName, true);
            $search = implode(', ', array_reverse($region));

            /**
             * Fix кривых регионов для dadata
             */
            switch (true) {
                case $search === 'пгт. Ува':
                    $search = 'Респ Удмуртская, п Ува';
                    break;
                case $search === 'р-н Чайковский':
                    $search = 'Пермский край, г Чайковский';
                    break;
                case $search === 'Лысьвенский р-н':
                    $search = 'Пермский край, г Лысьва';
                    break;
                case $search === 'Пермский край, Добрянский р-н':
                case $search === 'Пермский край, р-н Добрянский':
                case $search === 'Пермский край, Добрянский район':
                    $search = 'Пермский край, г Добрянка';
                    break;
                case $search === 'г. Радужный':
                    $search = 'Ханты-Мансийский Автономный округ - Югра, г Радужный';
                    break;
                case $search === 'Тюменская область, НПС-2 НП Пурпе-Самотлор р-н Пуровский':
                    $search = 'Ямало-Ненецкий АО, Пуровский р-н';
                    break;
                case $search === 'г.о. Златоустовский':
                    $search = 'Челябинская область, г. Златоуст';
                    break;
                case $search === 'г.о. Магнитогорский':
                    $search = 'Челябинская область, г. Магнитогорск';
                    break;
                case $search === 'г. Симферополь, Симферопольский р-он, г. Симферополь, Симферопольский р-он':
                    $search = 'Респ Крым, Симферопольский р-н';
                    break;
                case $search === 'г. Инская':
                    $search = 'г Новосибирск, ст Инская';
                    break;
                case $search === 'Республика Саха /Якутия/, р-н- Нерюнгринский':
                case $search === 'Улус Нерюнгринский':
                    $search = 'Респ Саха /Якутия/, г Нерюнгри';
                    break;
                case $search === 'Республика Саха /Якутия/, р-н Анабарский Национальный':
                    $search = 'Респ Саха /Якутия/, Анабарский улус';
                    break;
                case $search === 'АО. Ленинский':
                    $search = 'г Омск, тер Ленинский АО';
                    break;
                case $search === 'Белгородская обл., пгт. Красненский':
                    $search = 'Белгородская обл, Красненский р-н';
                    break;
                case $search === 'г.о. Борисоглебский':
                    $search = 'Воронежская обл, Борисоглебский р-н';
                    break;
                case $search === 'Тверская обл., р-н Спировский, пгт. Спирово':
                    $search = 'Тверская обл, п Спирово';
                    break;
                case $search === 'Рязанская обл., р-н Михайловский':
                    $search = 'г Рязань, р-н Михайловский';
                    break;
                case $search === 'Рязанская обл., р-н Александро-Невский':
                    $search = 'Рязанская обл, рп Александро-Невский';
                    break;
                case $search === 'п. Федюково':
                    $search = 'Московская обл, г Подольск, д Федюково';
                    break;
                case $search === 'р-н Рузский Санаторий Русь УПАТС "ЦВТ им. Лиходея"':
                    $search = 'Московская область, Рузский городской округ';
                    break;
                case $search === 'г. Москва (Троицкий), г. Москва (Троицкий)':
                case $search === 'г. Москва, г. Москва (Троицкий)':
                case $search === 'г. Москва (Новомосковский), г. Москва (Новомосковский)':
                case $search === 'г. Москва (Новомосковский)':
                case $search === 'Уральский федеральный округ, Приволжский федеральный округ':
                case $search === 'Российская Федерация, кроме Чукотского автономного округа':
                case $search === 'г. Москва и Московская область':
                case $search === 'Российская Федерация, кроме Чеченской Республики':
                case $search === 'Центральный федеральный округ':
                    $search = 'г. Москва';
                    break;
                case $search === 'Московская обл., р-н Наро-Фоминский, ЗАТО п. Молодёжный':
                    $search = 'Московская обл, Наро-Фоминский р-н, п Молодежный';
                    break;
                case $search === 'с.п. Пышлицкое':
                    $search = 'Московская обл, Шатурский р-н';
                    break;
                case $search === 'ЗАТО п. Восход':
                    $search = 'Московская обл, Истринский р-н, п Восход (ЗАТО)';
                    break;
                case $search === 'с.п. Луневское':
                    $search = 'Московская обл, г Солнечногорск';
                    break;
                case $search === 'Московская обл., р-н Щёлковский, ЗАТО п. Звездный городок':
                    $search = 'Московская обл, п Звездный городок';
                    break;
                case $search === 'Дальневосточный федеральный округ':
                    $search = 'Приморский край';
                    break;
                case $search === 'Северо-Западный федеральный округ':
                case $search === 'г. Санкт-Петербург и Ленинградская область':
                case $search === 'г. Санкт - Петербург и Ленинградская область':
                    $search = 'г. Санкт-Петербург';
                    break;
                case $search === 'Сибирский федеральный округ, Дальневосточный федеральный округ':
                    $search = 'г. Новосибирск';
                    break;
                case $search === 'г.п. Никольское':
                    $search = 'Ленинградская обл, Тосненский р-н, г Никольское';
                    break;
                case $search === 'Архангельская обл., г.о. Новая Земля':
                    $search = 'Архангельская обл, рп Белушья Губа';
                    break;
                case $search === 'п. Парца':
                    $search = 'Респ Мордовия, Зубово-Полянский р-н, п Парца(Вадово-Селищенское с/п)';
                    break;
                case $search === 'Камчатский край, Корякский округ':
                    $search = 'Камчатский край';
                    break;
                case $search === 'Архангельская область и Ненецкий автономный округ':
                    $search = 'Архангельская область';
                    break;
                case $search === 'Республика Крым и г. Севастополь':
                case $search === 'г. Севастополь и Республика Крым':
                    $search = 'г. Севастополь';
                    break;
                case $search === 'р-ны Абзелиловский и Белорецкий, р-ны Абзелиловский и Белорецкий':
                    $search = 'Респ Башкортостан, Абзелиловский р-н';
                    break;
                case $search === 'Сургутский район и г. Сургут':
                    $search = 'г. Сургут';
                    break;
            }

            /**
             * Check last update
             */
            $st = $this->db->prepare('select data from region_data where region_id = ? and type = "updated"');
            $st->execute([$regionId]);
            $lastUpdate = (int) $st->fetch(PDO::FETCH_COLUMN);

            // cache to 150 days
            if ($lastUpdate && $lastUpdate + 12960000 > time()) {
                $this->logger->debug('[dadata] Нет необходимости обновлять адрес: '.$search);
                continue;
            }

//            $cacheFile = __DIR__ . '/../storage/cache/region_'.$regionId.'.json';
//            if (! file_exists($cacheFile)) {
                $response = $this->guzzle->post('https://cleaner.dadata.ru/api/v1/clean/address', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Token '.$this->options['dadata']['api_key'],
                        'X-Secret' => $this->options['dadata']['secret'],
                    ],
                    'body' => json_encode([$search])
                ]);

                $addressData = json_decode($response->getBody()->getContents(), true);

//                file_put_contents(
//                    $cacheFile,
//                    json_encode($addressData, JSON_UNESCAPED_UNICODE)
//                );
//            } else {
//                $addressData = json_decode(file_get_contents($cacheFile), true);
//            }

            if ($addressData[0]['qc'] > 0) {
                $this->logger->warning(
                    '[dadata] Невозможно стандартизировать адрес: '.$search, [
                        'regionId' => $regionId,
                        'qc' => $addressData[0]['qc']
                    ]
                );
                continue;
            }

            $savedKeys = [
                'country',
                'country_iso_code',
                'result',
                'federal_district',
                'region_fias_id',
                'region_kladr_id',
                'region_iso_code',
                'region_type',
                'region',
                'fias_code',
                'fias_level',
                'kladr_id',
                'okato',
                'oktmo',
                'postal_code',
                'timezone',
                'geo_lat',
                'geo_lon',
            ];

            $regionData = [];
            foreach ($savedKeys as $key) {
                if (isset($addressData[0][$key]) && !is_null($addressData[0][$key])) {
                    $regionData[$key] = $addressData[0][$key];
                }
            }

            $st = $this->db->prepare('delete from region_data where region_id = ?');
            $st->execute([
                $regionId
            ]);

            if ($regionData) {
                $regionData['updated'] = time();

                foreach ($regionData as $key => $value) {
                    $st = $this->db->prepare(
                        'insert into region_data (region_id, type, data) values (?, ?, ?)'
                    );

                    $st->execute([
                        $regionId,
                        $key,
                        $value
                    ]);
                }
            }

            $this->logger->debug(
                '[dadata] Адрес стандартизирован: '.$search, ['keys' => array_keys($regionData)]
            );
        }
    }

    private function formatDataToResult(array $data): SearchResult
    {
        $result = new SearchResult();
        if(isset($data['region'])) {
            $region = new RegionResult();
            $region->setCountry($data['region']['country'])
                    ->setCountryIsoCode($data['region']['country_iso_code'])
                    ->setFederalDistrict($data['region']['federal_district'])
                    ->setFiasCode($data['region']['fias_code'])
                    ->setFiasLevel($data['region']['fias_level'])
                    ->setGeoLat($data['region']['geo_lat'])
                    ->setGeoLon($data['region']['geo_lon'])
                    ->setKladrId($data['region']['kladr_id'])
                    ->setOkato($data['region']['okato'])
                    ->setOktmo($data['region']['oktmo'])
                    ->setPostalCode($data['region']['postal_code'])
                    ->setRegionName($data['region']['region'])
                    ->setRegionFiasId($data['region']['region_fias_id'])
                    ->setRegionIsoCode($data['region']['region_iso_code'])
                    ->setRegionKladrId($data['region']['region_kladr_id'])
                    ->setRegionType($data['region']['region_type'])
                    ->setResult($data['region']['result'])
                    ->setTimezone($data['region']['timezone'])
                    ->setUpdated($data['region']['updated']);

            $result->setRegion($region);
        }

        $result->setCode($data['code'])
               ->setRegionId($data['region_id'])
               ->setNumberMax($data['number_max'])
               ->setNumberMin($data['number_min'])
               ->setOperatorId($data['operator_id'])
               ->setOperatorName($data['operator']);

        return $result;
    }
}