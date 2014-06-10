<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

date_default_timezone_set("Europe/Amsterdam");

define("EXT", ".php");
define("DS", DIRECTORY_SEPARATOR);
define("NS", "\\");
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']);
define("LOG_DIR", '/vagrant/var/www/log');

require_once("../library/Centralino/Core/Autoloader.php");

require_once('../vendor/autoload.php');

$autoload = new PSR4Autoloader();
$autoload->register();
$autoload->addNamespace('Centralino', '/vagrant/var/www/benny/library/Centralino');
$autoload->addNamespace('Centralino', '/vagrant/var/www/benny/tests/Centralino');
$autoload->addNamespace('Tests', '/vagrant/var/www/benny/tests');
