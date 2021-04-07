<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require dirname(__DIR__) . '/vendor/autoload.php';

$modules = [
    \App\Admin\AdminModule::class,
    \App\Blog\BlogModule::class
];
$app = (new \Framework\App(dirname(__DIR__) . '/config/config.php'))
    ->addModule(\App\Admin\AdminModule::class)
    ->addModule(\App\Blog\BlogModule::class);

if (php_sapi_name() !== "cli") {
    $response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
    \Http\Response\send($response);
}
