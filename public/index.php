<?php

use App\Blog\BlogModule;

require realpath(__DIR__ . '/../vendor/autoload.php');

$renderer = new \Framework\Renderer();
$renderer->addPath(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views');


$app = new \Framework\App([
    \App\Blog\BlogModule::class
], [
    'renderer' => $renderer,
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
