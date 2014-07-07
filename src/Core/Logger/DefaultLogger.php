<?php
namespace Centralino\Core\Logger;

use Centralino\Database;
use Psr\Log;

class DefaultLogger extends Log\AbstractLogger
{
    private $logdir;
    private $logName = false;

    public function __construct($logDir = LOG_DIR, $logName = 'messages.log')
    {
        $this->logdir = $logDir;

        if (! is_dir($this->logdir)) {
            mkdir($this->logdir, 0700, true);
        }

        $this->logName = $logName;
    }

    public function log($level, $message, array $context = array())
    {
        if (! $this->checkLogLevel($level)) {
            throw new Log\InvalidArgumentException();
        }

        $replace = array();
        foreach ($context as $key => $value) {
            if (is_scalar($value)) {
                $replace['{' . $key . '}'] = (string) $value;
            } elseif ($value instanceof \Exception) {
                $replace['{' . $key . '}'] = $this->exceptionToString($value);
            }
        }

        $fileHandle = fopen($this->logdir . DS . $this->logName, 'a+');

        $message = strtr($message, $replace);
        fwrite($fileHandle, $level . " " . $message."\n");
        fclose($fileHandle);
    }

    public function getLogs()
    {
        return file($this->logdir . DS . $this->logName, FILE_IGNORE_NEW_LINES);
    }

    public function clearLog()
    {
        $fileHandle = fopen($this->logdir . DS . $this->logName, "w");
        fclose($fileHandle);
    }

    private function checkLogLevel($level)
    {
        return in_array($level, array(
            Log\LogLevel::EMERGENCY,
            Log\LogLevel::ALERT,
            Log\LogLevel::CRITICAL,
            Log\LogLevel::ERROR,
            Log\LogLevel::WARNING,
            Log\LogLevel::NOTICE,
            Log\LogLevel::INFO,
            Log\LogLevel::DEBUG
            ));
    }


    private function exceptionToString(\Exception $exception)
    {
        $stack = $exception->getTrace();

        $traceString = '';
        $traceString .=  " message -> " . $exception->getMessage() . "\n";

        foreach ($stack as $trace) {

            if (isset($trace['class'])) {
                $traceString .=  " class -> " . $trace['class'] . "\n";
            }

            if (isset($trace['function'])) {
                $traceString .=  " function -> " . $trace['function'] . "\n";
            }

            if (isset($trace['line'])) {
                $traceString .=  " line -> " . $trace['line'] . "\n";
            }

            if (isset($trace['file'])) {
                $traceString .=  " file -> " . $trace['file'] . "\n";
            }

            $traceString .=  " \n";
        }

        return $traceString;
    }
}
