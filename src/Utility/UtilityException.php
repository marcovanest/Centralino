<?php
namespace Centralino\Utility;

use Centralino\Core;

class UtilityException extends Core\Exception\CustomException
{
    public function __construct($message)
    {
        parent::__construct($message, 555, null);
    }
}
