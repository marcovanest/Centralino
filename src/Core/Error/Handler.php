<?php
namespace Centralino\Core\Error;

use Psr\Log;

class Handler
{
    private $logger = null;

    public function __construct(Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handleError($errno, $errstr, $errfile, $errline, array $errcontext)
    {

    }
}
