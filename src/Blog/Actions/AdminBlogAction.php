<?php
namespace App\Blog\Actions;

use App\Blog\Table\PostTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use Framework\Session\FlashService;
use Framework\Session\SessionInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdminBlogAction
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;
    /**
     * @var PostTable
     */
    private $postTable;

    /**
     * @var FlashService
     */
    private $flash;

    use RouterAwareAction;

    public function __construct(
        RendererInterface $renderer,
        Router $router,
        PostTable $postTable,
        FlashService $flash
    ) {
    
        $this->renderer = $renderer;
        $this->router = $router;
        $this->postTable = $postTable;
        $this->flash = $flash;
    }

    public function __invoke(Request $request)
    {
        if ($request->getMethod() === 'DELETE') {
            return $this->delete($request);
        }
        if (substr((string)$request->getUri(), -3) === 'new') {
            return $this->create($request);
        }
        if ($request->getAttribute('id')) {
            return $this->edit($request);
        }
        return $this->index($request);
    }

    public function index(Request $request): string
    {
        $params = $request->getQueryParams();
        $items = $this->postTable->findPaginated(12, $params['p'] ?? 1);

        return $this->renderer->render('@blog/admin/index', compact('items'));
    }

    /**
     * Edite un article
     * @param Request $request
     * @return ResponseInterface|string
     */
    public function edit(Request $request)
    {
        $item = $this->postTable->find($request->getAttribute('id'));

        if ($request->getMethod() === 'POST') {
            $params = $this->getParams($request);
            $params['updated_at'] = date('Y-m-d H:i:s');
            $this->postTable->update($item->id, $params);
            $this->flash->success('L\'article a bien ??t?? modifi??');
            return $this->redirect('blog.admin.index');
        }

        return $this->renderer->render('@blog/admin/edit', compact('item'));
    }

    /**
     * Cr??e un nouvel article
     * @param Request $request
     * @return ResponseInterface|string
     */
    public function create(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $params = $this->getParams($request);
            $params = array_merge($params, [
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $this->postTable->insert($params);
            $this->flash->success('L\'article a bien ??t?? modifi??');
            return $this->redirect('blog.admin.index');
        }

        return $this->renderer->render('@blog/admin/create', compact('item'));
    }

    public function delete(Request $request)
    {
        $this->postTable->delete($request->getAttribute('id'));
        return $this->redirect('blog.admin.index');
    }

    private function getParams(Request $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['name', 'slug', 'content']);
        }, ARRAY_FILTER_USE_KEY);
    }
}
