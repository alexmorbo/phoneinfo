# Phone standardization library
**PhoneInfo** is a php library to get information by russian and kazakhstan phone number.

## Goal
Goal of this project is to get information about russian and kazakhstan phone easy and free. 
Regional information about russian phones taken from https://dadata.ru

## Examples
Examples located at example directory.

## Base
Database stored locally (storage/default.sqlite) in sqlite3 database.
For now only sqlite3 (PDO) is supported.

## Usage

- Installation via composer
```
composer require alexmorbo/phoneinfo
```
- Create library object
```
use PhoneLib\PhoneInfo;
$library = new PhoneInfo();
```
- Get information about phone
```
$info = $library->search('79014300001');
```
- Profit
```
PhoneLib\SearchResult Object
(
    [code:PhoneLib\SearchResult:private] => 901
    [err:PhoneLib\SearchResult:private] =>
    [number:PhoneLib\SearchResult:private] => 79014300001
    [countryCode:PhoneLib\SearchResult:private] => 7
    [nationalFormat:PhoneLib\SearchResult:private] => 8 (901) 430-00-01
    [internationalFormat:PhoneLib\SearchResult:private] => +7 901 430-00-01
    [numberMin:PhoneLib\SearchResult:private] => 79014300000
    [numberMax:PhoneLib\SearchResult:private] => 79014399999
    [regionId:PhoneLib\SearchResult:private] => 3408
    [operatorId:PhoneLib\SearchResult:private] => 8
    [operatorName:PhoneLib\SearchResult:private] => ООО "Т2 Мобайл"
    [region:PhoneLib\SearchResult:private] => PhoneLib\RegionResult Object
        (
            [country:PhoneLib\RegionResult:private] => Россия
            [countryIsoCode:PhoneLib\RegionResult:private] => RU
            [federalDistrict:PhoneLib\RegionResult:private] => Уральский
            [fiasCode:PhoneLib\RegionResult:private] => 66000000000000000000000
            [fiasLevel:PhoneLib\RegionResult:private] => 1
            [geoLat:PhoneLib\RegionResult:private] =>
            [geoLon:PhoneLib\RegionResult:private] =>
            [kladrId:PhoneLib\RegionResult:private] => 6600000000000
            [okato:PhoneLib\RegionResult:private] => 65000000000
            [oktmo:PhoneLib\RegionResult:private] =>
            [postalCode:PhoneLib\RegionResult:private] => 620000
            [regionName:PhoneLib\RegionResult:private] => Свердловская
            [regionFiasId:PhoneLib\RegionResult:private] => 92b30014-4d52-4e2e-892d-928142b924bf
            [regionIsoCode:PhoneLib\RegionResult:private] => RU-SVE
            [regionKladrId:PhoneLib\RegionResult:private] => 6600000000000
            [regionType:PhoneLib\RegionResult:private] => обл
            [result:PhoneLib\RegionResult:private] => Свердловская обл
            [timezone:PhoneLib\RegionResult:private] => UTC+5
            [updated:PhoneLib\RegionResult:private] => 1573643700
        )
    [libphonenumberData:PhoneLib\SearchResult:private] => libphonenumber\PhoneNumber Object
        (
            [countryCode:protected] => 7
            [nationalNumber:protected] => 9014315596
            [extension:protected] => 
            [italianLeadingZero:protected] => 
            [rawInput:protected] => 
            [countryCodeSource:protected] => 4
            [preferredDomesticCarrierCode:protected] => 
            [hasNumberOfLeadingZeros:protected] => 
            [numberOfLeadingZeros:protected] => 1
        )

)
```
