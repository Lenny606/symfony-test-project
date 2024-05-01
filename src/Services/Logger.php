<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{
    private static $logFile = 'logs/log.txt';

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement error() method.
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement warning() method.
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement notice() method.
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement info() method.
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        // You can implement your logging logic here, such as writing to a file, database, or outputting to console
        $logMessage = sprintf("[%s] %s: %s\n", date('Y-m-d H:i:s'), $level, $message);

        // Optionally, you can include context data in the log message
        if (!empty($context)) {
            $logMessage .= "Context: " . json_encode($context) . "\n";
        }

        if(!file_exists(self::$logFile)){
            mkdir('/logs',777,true);
            chmod("logs", 777);
            touch(self::$logFile);
        }

        // Append the log message to the log file
        file_put_contents(self::$logFile, $logMessage, FILE_APPEND);
    }
}