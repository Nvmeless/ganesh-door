<?php

use App\Blog\BlogModule;

require realpath(__DIR__ . '/../vendor/autoload.php');

$renderer = new \Framework\Renderer\PHPRenderer(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views');
//$loader = new Twig_Loader_Filesystem(dirname(__DIR__). DIRECTORY_SEPARATOR . 'Views');
//$twig = new Twig_Environment($loader, []);

$app = new \Framework\App([
    \App\Blog\BlogModule::class
], [
    'renderer' => $renderer,
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
