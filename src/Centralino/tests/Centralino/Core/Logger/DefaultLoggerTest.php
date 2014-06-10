<?php
namespace Centralino\Core\Logger;

use Psr\Log\Test as PsrLogTest;

class DefaultLoggerTest extends PsrLogTest\LoggerInterfaceTest
{
    private $logger;

    public function getLogger()
    {
        $this->logger = new DefaultLogger(LOG_DIR . DS . 'tests', 'logger.log');
        $this->logger->clearLog();

        return $this->logger;
    }

    public function getLogs()
    {
        return $this->logger->getLogs();
    }
}