<?php

namespace App\Blog\Actions;

use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogAction
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     *
     * @var Router
     */
    private $router;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, \PDO $pdo, Router $router)
    {
        $this->pdo = $pdo;
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request)
    {
        if ($request->getAttribute('id')) {
            return $this->show($request);
        }
        return $this->index();
    }

    public function index(): string
    {
        $posts = $this->pdo
            ->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 10')
            ->fetchAll();
        return $this->renderer->render('@blog/index', ['posts' => $posts]);
    }

    public function show(Request $request): string
    {
        $slug = $request->getAttribute('slug');
        $query = $this->pdo
            ->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute([$request->getAttribute('id')]);
        $post = $query->fetch();

        if ($post->slug !== $slug) {
            $redirectUri = $this->router->generateUri('blog.show', [
                'slug' => $post->slug,
                'id' => $post->id
            ]);

            return (new Response())
                ->withStatus(301)
                ->withHeader('location', $redirectUri);
        }
        return $this->renderer->render('@blog/show', [
            'post' => $post
        ]);
    }
}
