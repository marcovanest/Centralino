<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

date_default_timezone_set("Europe/Amsterdam");
require_once(__DIR__.'/../../../autoload.php');

$autoloader = new \Centralino\Core\Autoloader();
$autoloader->register();
$autoloader->addNamespace('Centralino', '../../var/www/tests/');

define("EXT", ".php");
define("DS", DIRECTORY_SEPARATOR);
define("NS", "\\");
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']);
define("LOG_DIR", '/vagrant/var/www/log');
