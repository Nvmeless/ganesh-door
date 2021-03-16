<?php
class TwigRenderer implements RendererInterface{

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
        $loader = new \Twig_Loader_Filesystem($path);
        $twig = new \Twig_Environment($loader,[]);
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

    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return boolean
     */
    private function hasNamespace(string $view): bool
    {
    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return string
     */
    private function getNamespace(string $view): string
    {

    }
    /**
     * Undocumented function
     *
     * @param string $view
     * @return string
     */
    private function replaceNamespace(string $view): string
    {

    }
?>