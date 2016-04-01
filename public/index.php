<?php
ini_set('display_errors', getenv('app.debug'));
error_reporting(E_ALL);
define("DS", DIRECTORY_SEPARATOR);
define ('ROOT', dirname(__DIR__));
define ('ROOT_APP', ROOT . '/app');
define("ROUTERS_DIR", ROOT_APP . "/routers" . DS);

require '../app/bootstrap.php';
$app->run();