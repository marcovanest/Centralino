<?php
namespace Centralino\Database;

use Centralino\Core;

class DatabaseException
    extends Core\Exception\CustomException
    implements Core\Exception\LoggableExceptionInterface
{
    private $level = null;

    public function __construct($message, $level)
    {
        $this->level = $level;

        parent::__construct($message, 666, null);
    }

    public function setLogLevel($level)
    {
        $this->level = $level;
    }

    public function getLogLevel()
    {
        return $this->level;
    }
}