<?php
namespace Centralino\Repository;

class RepositoryAbstract
{
    public function dbManager()
    {
        $connectionParams = array(
            'host'=>'localhost',
            'port'=>null,
            'dbname'=>'benny_test',
            'dbuser'=>'postgres',
            'dbpass'=>'tar',
            'options'=>array()
        );

        return \Centralino\Database\Connection::createPDOConnection('pgsql', $connectionParams);
    }
}
