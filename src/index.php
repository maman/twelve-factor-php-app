<?php

session_start();

$app = new \Slim\App([
    'settings' => ['displayErrorDetails' => true]
]);
$container = $app->getContainer();

// Sensible PHP Settings
error_reporting('E_ALL');
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set('error_log', __DIR__ . '/../logs/php.log');
date_default_timezone_set('Asia/Jakarta');

// Inject deps
require __DIR__ . '/dependencies.php';

foreach (glob(__DIR__ . '/routes/*.php') as $route) {
    require $route;
}

$app->run();
