<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo __DIR__;
// require_once("Core/Autoloader.php");
// require_once('benny/vendfor/autoload.php');

/*
date_default_timezone_set("Europe/Amsterdam");

define("EXT", ".php");
define("DS", DIRECTORY_SEPARATOR);
define("NS", "\\");
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']);
define("LOG_DIR", ROOT_DIR . DS . 'log');

define("DB_NAME", 'benny_test');
define("DB_HOST", 'localhost');
define("DB_USER", 'postgres');
define("DB_PASS", 'tar');
define("DB_DRIVER", 'pgsql');

$autoload = new PSR4Autoloader();
$autoload->register();
$autoload->addNamespace('Centralino', 'benny/library/Centralino');
$autoload->addNamespace('Centralino', 'benny/tests/Centralino');
$autoload->addNamespace('Tests', 'benny/tests');

$logger           = new Centralino\Core\Logger\DefaultLogger(LOG_DIR . DS . 'tests', 'database.log');
$exceptionHandler = new Centralino\Core\Exception\Handler($logger);

set_exception_handler(array($exceptionHandler , 'handleException'));


*/