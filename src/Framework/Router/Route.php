<?php

namespace Framework\Router;

/**
 * Class Route
 * Represent a matched Route
 */
class Route
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    private $name;
    /**
     * Undocumented variable
     *
     * @var callable
     */
    private $callable;
    /**
     * Undocumented variable
     *
     * @var array
     */
    private $parameters;



    public function __construct(string $name, callable $callable, array $parameters)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->parameters = $parameters;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callable;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}
