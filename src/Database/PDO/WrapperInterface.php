<?php
namespace Centralino\Database\PDO;

interface WrapperInterface
{
    public function prepare($query);
    public function select($sqlStatement, $sqlParams, $fetchMode, $fetchParam);
    public function update($sqlStatement, $sqlParams);
    public function delete($sqlStatement, $sqlParams);
}
