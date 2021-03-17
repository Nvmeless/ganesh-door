<?php

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRenderer;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;

return [
    'views.path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views',
    Router::class => \DI\object(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
];
