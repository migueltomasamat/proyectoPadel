<?php

namespace App\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LogFactory
{

    public static function getLogger(string $canal="miApp"):LoggerInterface{
        $log = new Logger($canal);
        $log->pushHandler(new StreamHandler(__DIR__."/miApp.log"),Logger::DEBUG);

        return $log;
    }

}