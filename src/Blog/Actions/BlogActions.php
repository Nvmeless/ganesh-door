<?php
namespace App\Blog\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;

class BlogAction {
    
    /**
     *
     * @var RendererInterface
     */
    private $renderer;


    public function __construct(RendererInterface $renderer){
        $this->renderer = $renderer;
    }
    public function index(Request $request): string
    {
        return $this->renderer->render('@blog/index');
    }
    public function show(Request $request): string
    {
        return $this->renderer->render(
            '@blog/show',
            [
                'slug' => $request->getAttribute('slug')
            ]
        );
    }

}