<?php

namespace Framework\Renderer;

class PHPRenderer implements RendererInterface
{

    const DEFAULT_NAMESPACE = '__DEFAULT_MAIN';

    /**
     * List of paths
     *
     * @var array
     */
    private $paths = [];

    /**
     * Globales Variables that can be used by all the views
     *
     * @var array
     */
    private $globals = [];

    function __construct(?string $defaultPath = null ){
        if(!is_null($defaultPath)){
            $this->addPath($defaultPath);
        }
    }
    /**
     * Permit to add a path to load views
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
     * Permit to render a view
     * The path can be precised by namespace via addPath
     * $this->render('@blog/view');
     * $this->render('view');
     * @param string $view
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) . '.php';
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
        }
        ob_start();
        $renderer = $this;
        extract($this->globals);
        extract($params);
        require($path);
        return ob_get_clean();
    }
    /**
     * ermit to add Globals variables to all the views
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function addGlobal(string $key, $value): void
    {
        $this->globals[$key] = $value;
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
