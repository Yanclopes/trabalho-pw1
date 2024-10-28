<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

use App\Core\Core;
require 'vendor/autoload.php';
require_once __DIR__."/src/Config/env.php";
require_once __DIR__ . "/src/Config/Database.php";
require_once __DIR__."/src/Router/routes.php";
require_once __DIR__."/src/Core/Core.php";
require_once __DIR__."/src/Exception/exceptionHandler.php";


set_exception_handler('exceptionHandler');

$core = new Core($routes);
$core->run();
