<?php

namespace Tests\Framework;

use App\Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;
use Tests\Framework\Modules\ErroredModule;
use Tests\Framework\Modules\StringModule;

class AppTest extends TestCase
{


    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/demoslash/');
        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }
    public function testBlog()
    {

        $app = new App([
            BlogModule::class
        ]);

        $request = new ServerRequest('GET', '/blog');
        $requestSingle = new ServerRequest('GET', '/blog/article-de-test');

        $response = $app->run($request);
        $responseSingle = $app->run($requestSingle);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('<h1>Bienvenue sur mon blog !</h1>', (string)$response->getBody());
        $this->assertEquals(200, $responseSingle->getStatusCode());
        $this->assertStringContainsString('<h1> Bienvenue sur article-de-test</h1>', (string)$responseSingle->getBody());
    }
    public function testError404()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/fhfqsofhoich');
        $response = $app->run($request);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('<h1>Erreur 404</h1>', (string)$response->getBody());
    }
    public function testThrowExceptionIfNoResponseSent()
    {
        $app = new App([
            ErroredModule::class
        ]);
        $request = new ServerRequest('GET', '/demo');

        $this->expectException(\Exception::class);
        $app->run($request);
    }

    public function testConvertStringToResponse()
    {
        $app = new App([
            StringModule::class
        ]);
        $request = new ServerRequest('GET', '/demo');
        $response = $app->run($request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('DEMO', (string)$response->getBody());
    }
}
