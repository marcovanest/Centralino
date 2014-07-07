<?php
namespace Centralino\Core\Exception;

interface LoggableExceptionInterface
{
    public function setLogLevel($level);
    public function getLogLevel();
}
