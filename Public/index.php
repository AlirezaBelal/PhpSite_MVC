<?php


require_once  __DIR__ . '/../vendor/autoload.php';

use App\core\Application;

$app = Application::get_instance(dirname(__DIR__));

$app->run();
