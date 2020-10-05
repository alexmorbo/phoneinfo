<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PhoneLib\PhoneInfo;

require __DIR__ . '/../vendor/autoload.php';

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));

$options = [
    'logger' => $logger,
//    'dadata' => [
//        'api_key' => '', // Your dadata api key
//        'secret' => '', // Your dadata api secret
//    ],
];

$library = new PhoneInfo($options);
$library->update();