<?php


require realpath(__DIR__ . '/../vendor/autoload.php');

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
$builder->addDefinitions(dirname(__DIR__)  . DIRECTORY_SEPARATOR . 'config.php');
$container = $builder->build();

$container->get(\Framework\Renderer\RendererInterface::class);



$app = new \Framework\App($container, [
    \App\Blog\BlogModule::class
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
