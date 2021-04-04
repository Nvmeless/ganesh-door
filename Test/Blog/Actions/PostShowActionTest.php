<?php

namespace Tests\App\Blog\Actions;

use App\Blog\Actions\PostShowAction;
use App\Blog\Entity\Post;
use App\Blog\Table\PostTable;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class PostShowActionTest extends TestCase
{

    /**
     * @var PostShowActionTest
     */
    private $action;

    private $renderer;

    private $postTable;

    private $router;

    public function setUp(): void
    {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->postTable = $this->prophesize(PostTable::class);
        // PDO
        $this->router = $this->prophesize(Router::class);
        $this->action = new PostShowAction(
            $this->renderer->reveal(),
            $this->router->reveal(),
            $this->postTable->reveal()
        );
    }

    public function makePost(int $id, string $slug): Post
    {
        // Article
        $post = new Post();
        $post->id = $id;
        $post->slug = $slug;
        return $post;
    }

    public function testShowRedirect()
    {
        $post = $this->makePost(9, "azezae-azeazae");
        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', $post->id)
            ->withAttribute('slug', 'demo');

        $this->router->generateUri(
            'blog.show',
            ['id' => $post->id, 'slug' => $post->slug]
        )->willReturn('/demo2');
        $this->postTable->findWithCategory($post->id)->willReturn($post);

        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals(['/demo2'], $response->getHeader('location'));
    }

    public function testShowRender()
    {
        $post = $this->makePost(9, "azezae-azeazae");
        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', $post->id)
            ->withAttribute('slug', $post->slug);
        $this->postTable->findWithCategory($post->id)->willReturn($post);
        $this->renderer->render('@blog/show', ['post' => $post])->willReturn('');

        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(true, true);
    }
}
