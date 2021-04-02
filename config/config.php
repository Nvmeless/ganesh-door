<?php

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;
use Framework\Router\RouterTwigExtension;
use Framework\Session\PHPSession;
use Framework\Session\SessionInterface;
use Framework\Twig\{
  FlashExtension,
  PagerFantaExtension,
  TextExtension,
  TimeExtension
};

return [
  'database.host' => 'localhost',
  'database.username' => 'USERNAME',
  'database.password' => '******',
  'database.name' => 'ganesh-door',
  'database.port' => '80',
  'database.charset' => 'utf8-bin',
  'views.path' => dirname(__DIR__) . '/Views',
  'twig.extensions' => [
    \DI\get(RouterTwigExtension::class),
    \DI\get(PagerFantaExtension::class),
    \DI\get(TextExtension::class),
    \DI\get(TimeExtension::class),
    \DI\get(FlashExtension::class)
  ],
  SessionInterface::class => \DI\object(PHPSession::class),
  Router::class => \DI\object(),
  RendererInterface::class => \DI\factory(TwigRendererFactory::class),
  \PDO::class => function (\Psr\Container\ContainerInterface $c) {
    return new PDO(
      'mysql:host=' . $c->get('database.host') . ';dbname=' . $c->get('database.name'),
      $c->get('database.username'),
      $c->get('database.password'),
      [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
    );
  }
];
