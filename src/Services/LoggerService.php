<?php
declare(strict_types=1);

namespace App\Services;

use App\Services\Interface\LoggerInterface;
use phpDocumentor\Reflection\File;

class LoggerService implements LoggerInterface
{
    //TODO should be in constructor
    private string $logFolder = "/../logs";
    private string $logFilePath = "";
    private string $fileNameExtension =  '.txt';
    public function __construct(

    ){
    }

    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    public function info($message, array $context = array()): void
    {
        $this->log('info', $message, $context);
    }

    public function access($message, array $context = array()): void
    {
        $this->log('access-log', $message, $context);
    }

    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
    }

    public function log($level, $message, array $context = array()): void
    {
        // Vytvori záznam
        $logEntry = sprintf("[%s] %s: %s\n", $level, $message, json_encode($context));
        $fileName = sprintf("$level$this->fileNameExtension");
        $fullLogPath = sprintf("%s/%s/%s", $_SERVER['DOCUMENT_ROOT'] , $this->logFolder , $fileName);

        // Přidání záznamu do souboru
        if(!is_dir($_SERVER['DOCUMENT_ROOT'] . $this->logFolder)){
            mkdir($this->logFolder, 777, true);
            touch($fullLogPath);
        }
        if(!file_exists($fullLogPath)){
            touch($fullLogPath);
        }
        file_put_contents($fullLogPath, $logEntry, FILE_APPEND);
    }
}