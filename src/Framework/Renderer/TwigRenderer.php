<?php

namespace Framework\Renderer;

class TwigRenderer implements RendererInterface
{

    private $twig;
    private $loader;

    public function __construct(string $path)
    {
        $this->loader = new \Twig_Loader_Filesystem($path);
        $this->twig = new \Twig_Environment($this->loader, []);
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
        $this->loader->addPath($path, $namespace);
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
        return $this->twig->render($view . '.twig', $params);
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
        $this->twig->addGlobal($key, $value);
    }
}
