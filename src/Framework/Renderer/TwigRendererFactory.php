<?php

namespace Framework\Renderer;

use Psr\Container\ContainerInterface;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        return new TwigRenderer($container->get('views.path'));
    }
}
