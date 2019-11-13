# Phone standardization library
**PhoneInfo** is a php library to get information by russian phone number.

## Goal
Goal of this project is to get information about russian phone easy and free. 
Regional information taken from https://dadata.ru

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
$info = $library->search('79213333333');
```
- Profit
```
PhoneLib\SearchResult Object
(
    [code:PhoneLib\SearchResult:private] => 921
    [numberMin:PhoneLib\SearchResult:private] => 79213000000
    [numberMax:PhoneLib\SearchResult:private] => 79214499999
    [regionId:PhoneLib\SearchResult:private] => 2105
    [operatorId:PhoneLib\SearchResult:private] => 14
    [operatorName:PhoneLib\SearchResult:private] => ПАО "МегаФон"
    [region:PhoneLib\SearchResult:private] => PhoneLib\RegionResult Object
        (
            [country:PhoneLib\RegionResult:private] => Россия
            [countryIsoCode:PhoneLib\RegionResult:private] => RU
            [federalDistrict:PhoneLib\RegionResult:private] => Северо-Западный
            [fiasCode:PhoneLib\RegionResult:private] => 78000000000000000000000
            [fiasLevel:PhoneLib\RegionResult:private] => 1
            [geoLat:PhoneLib\RegionResult:private] => 59
            [geoLon:PhoneLib\RegionResult:private] => 30
            [kladrId:PhoneLib\RegionResult:private] => 7800000000000
            [okato:PhoneLib\RegionResult:private] => 40000000000
            [oktmo:PhoneLib\RegionResult:private] => 40000000
            [postalCode:PhoneLib\RegionResult:private] => 190000
            [regionName:PhoneLib\RegionResult:private] => Санкт-Петербург
            [regionFiasId:PhoneLib\RegionResult:private] => c2deb16a-0330-4f05-821f-1d09c93331e6
            [regionIsoCode:PhoneLib\RegionResult:private] => RU-SPE
            [regionKladrId:PhoneLib\RegionResult:private] => 7800000000000
            [regionType:PhoneLib\RegionResult:private] => г
            [result:PhoneLib\RegionResult:private] => г Санкт-Петербург
            [timezone:PhoneLib\RegionResult:private] => UTC+3
            [updated:PhoneLib\RegionResult:private] => 1573643679
        )

)
```
