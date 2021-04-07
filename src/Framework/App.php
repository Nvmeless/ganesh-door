<?php

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{


    /**
     * List of modules
     * @var array
     */
    private $modules = [];
    
    
    /**
     * Paths des configs
     *
     * @var string
     */
    private $definition;

    /**
     * Instance de Container Interface 
     *
     * @var ContainerInterface
     */
    private $container; 

    public function __construct(string $definition){
        $this->definition =  $definition;
    }

    public function addModule(string $module) :self
    {
        $this->modules[] = $module;
        return $this;
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        foreach($this->modules as $module ){
            $this->getContainer()->get($module);// ICI 5:13
        }
        $uri = $request->getUri()->getPath();
        $parsedBody = $request->getParsedBody();
        if (array_key_exists('_method', $parsedBody) &&
            in_array($parsedBody['_method'], ['DELETE', 'PUT'])
        ) {
            $request = $request->withMethod($parsedBody['_method']);
        }
        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        $router = $this->container->get(Router::class);
        $route = $router->match($request);
        if (is_null($route)) {
            return new Response(404, [], '<h1>Erreur 404</h1>');
        }
        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);
        $callback = $route->getCallback();
        if (is_string($callback)) {
            $callback = $this->container->get($callback);
        }
        $response = call_user_func_array($callback, [$request]);
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception('The response is not a string or an instance of ResponseInterface');
        }
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        if ($this->container === null) {
            $builder = new \DI\ContainerBuilder();
            $builder->addDefinitions($this->definition);
            foreach ($this->modules as $module) {
                if ($module::DEFINITIONS) {
                    $builder->addDefinitions($module::DEFINITIONS);
                }
            }
            $this->container = $builder->build();
        }
        return $this->container;
    }
}
