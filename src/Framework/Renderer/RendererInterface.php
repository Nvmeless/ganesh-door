<?php

namespace Framework\Renderer;

interface RendererInterface
{ 
    /**
     * Permit to add a path to load views
     *
     * @param string $namespace
     * @param string|null $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null):void;
    /**
     * Permit to render a view
     * The path can be precised by namespace via addPath
     * $this->render('@blog/view');
     * $this->render('view');
     * @param string $view
     * @return string
     */
    public function render(string $view, array $params = []):string;
    /**
     * ermit to add Globals variables to all the views
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function addGlobal(string $key, $value):void;
   
}