<?php
namespace Centralino\Database;

interface PDOWrapperInterface
{
    public function connect();
    public function disconnect();

    public function prepare($query);
}
