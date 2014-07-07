<?php
namespace Centralino\Utility;

abstract class UtilityAbstract
{
    public function throwException($message)
    {
        throw new UtilityException($message);
    }
}
