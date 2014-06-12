<?php
namespace Centralino\Core\Exception;

interface HandlerInterface
{
    public function handleException(\Exception $logger);
}