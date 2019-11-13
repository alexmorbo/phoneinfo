<?php

use libphonenumber\PhoneNumberUtil;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PhoneLib\PhoneInfo;

require __DIR__ . '/../vendor/autoload.php';

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));

$options = [
    'logger' => $logger,
//    'libphonenumber' => true,
//    'libphonenumber' => PhoneNumberUtil::getInstance(),
];

$library = new PhoneInfo($options);
print_r($library->search('79213333333'));
//Array
//(
//    [code] => 921
//    [number_min] => 79213000000
//    [number_max] => 79214499999
//    [region_id] => 2105
//    [operator_id] => 14
//    [operator] => ПАО "МегаФон"
//    [region] => Array
//    (
//        [country] => Россия
//        [country_iso_code] => RU
//        [federal_district] => Северо-Западный
//        [fias_code] => 78000000000000000000000
//        [fias_level] => 1
//        [geo_lat] => 59.9391313
//        [geo_lon] => 30.3159004
//        [kladr_id] => 7800000000000
//        [okato] => 40000000000
//        [oktmo] => 40000000
//        [postal_code] => 190000
//        [region] => Санкт-Петербург
//        [region_fias_id] => c2deb16a-0330-4f05-821f-1d09c93331e6
//        [region_iso_code] => RU-SPE
//        [region_kladr_id] => 7800000000000
//        [region_type] => г
//        [result] => г Санкт-Петербург
//        [timezone] => UTC+3
//        [updated] => 1573643679
//    )
//)