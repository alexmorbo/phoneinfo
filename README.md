# Phone standardization library
**PhoneInfo** is an php library to get information by russian phone number.

## Goal
Goal of this project is get information about russian phone easy and free. 
Regional information takes from https://dadata.ru

## Examples
Examples located at example directory.

## Base
Database stored localy (storage/default.sqlite) in sqlite3 database.
At this time only sqlite3 (PDO) allowed to storage data.

## Usage

- Installation via composer
```composer require alexmorbo/phoneinfo```
- Create library object
```$library = new PhoneInfo();```
- Get information about phone
```$info = $library->search('79213333333');```
- Profit
```
Array
(
    [code] => 921
    [number_min] => 79213000000
    [number_max] => 79214499999
    [region_id] => 2105
    [operator_id] => 14
    [operator] => ПАО "МегаФон"
    [region] => Array
        (
            [country] => Россия
            [country_iso_code] => RU
            [federal_district] => Северо-Западный
            [fias_code] => 78000000000000000000000
            [fias_level] => 1
            [geo_lat] => 59.9391313
            [geo_lon] => 30.3159004
            [kladr_id] => 7800000000000
            [okato] => 40000000000
            [oktmo] => 40000000
            [postal_code] => 190000
            [region] => Санкт-Петербург
            [region_fias_id] => c2deb16a-0330-4f05-821f-1d09c93331e6
            [region_iso_code] => RU-SPE
            [region_kladr_id] => 7800000000000
            [region_type] => г
            [result] => г Санкт-Петербург
            [timezone] => UTC+3
            [updated] => 1573643679
        )

)
```
