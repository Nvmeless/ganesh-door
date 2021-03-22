<?php

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router\RouterTwigExtension;

return [
  'database.host' => 'localhost',
  'database.username' => 'jinn',
  'database.password' => 'RoseBUD31420',
  'database.name' => 'ganesh-door',
  'database.port' => '80',
  'database.charset' => 'utf8-bin',
  'views.path' => dirname(__DIR__) . '/Views',
  'twig.extensions' => [
    \DI\get(RouterTwigExtension::class)
  ],
  \Framework\Router::class => \DI\object(),
  RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];
