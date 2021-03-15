<?php

namespace Framework;

use Framework\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Register and match Routes
 */
class Router
{
    /**
     * Undocumented variable
     *
     * @var FastRouteRouter
     */
    private $router;

    public function __construct()
    {
        $this->router =  new FastRouteRouter();
    }
    /**
     * Undocumented function
     *
     * @param string $path
     * @param callable $callable
     * @param string $name
     */
    public function get(string $path, callable $callable, string $name)
    {
        //Rajouter une fonction qui slug automatiquement une string ex: "http://www.toto.com/salut-je-suis-supercontent('%20' === '-')2" > "http://www.toto.com/SalutJeSuisSupercontent 2" 
        $this->router->addRoute(new ZendRoute($path, $callable, ['GET'], $name));
    }
    /**
     * Undocumented function
     *
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $result = $this->router->match($request);
        if ($result->isSuccess()) {
            return new Route(
                $result->getMatchedRouteName(),
                $result->getMatchedMiddleware(),
                $result->getMatchedParams()
            );
        }
        return null;
    }

    public function generateUri(string $name, array $params): ?string
    {
        return $this->router->generateUri($name, $params);
    }
}
