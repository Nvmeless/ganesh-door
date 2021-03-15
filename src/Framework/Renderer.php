<?php

namespace Framework;

class Renderer
{

    const DEFAULT_NAMESPACE = '__DEFAULT_MAIN';

    /**
     * Undocumented variable
     *
     * @var array
     */
    private $paths = [];

    /**
     * Undocumented function
     *
     * @param string $namespace
     * @param string|null $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return string
     */
    public function render(string $view): string
    {
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) . '.php';
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
        }
        ob_start();
        require($path);
        return ob_get_clean();
    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return boolean
     */
    private function hasNamespace(string $view): bool
    {
        return $view[0] === '@';
    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return string
     */
    private function getNamespace(string $view): string
    {
        return substr($view, 1, strpos($view, '/') - 1);
    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return string
     */
    private function replaceNamespace(string $view): string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }
}
