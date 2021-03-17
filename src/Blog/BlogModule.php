<?php

namespace App\Blog;

use Framework\Renderer\RendererInterface;
use Framework\Router;
use Framework\Module;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule extends Module
{
    const DEFINITIONS = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';

    private $renderer;
    public function __construct(string $prefix,Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__ . DIRECTORY_SEPARATOR .'Views');
        $router->get($prefix, [$this, 'index'], 'blog.index');
        $router->get($prefix .'/{slug:[a-z\-0-9]+}', [$this, 'show'], 'blog.show');
    }
 
}
