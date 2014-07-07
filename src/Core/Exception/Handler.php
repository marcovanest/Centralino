<?php
namespace Centralino\Core\Exception;

use Psr\Log;

class Handler
{
    private $logger = null;

    public function __construct(Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handleException(\Exception $exception)
    {
        if ($exception instanceof LoggableExceptionInterface) {
            $this->logger->log($exception->getLogLevel(), $exception->getMessage());
        }

        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "<table>";
        echo $exception->xdebug_message;
        echo "</table>";
        die();
    }
}
