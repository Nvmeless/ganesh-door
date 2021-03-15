<?php

namespace Tests\Framework;

use Framework\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    /**
     * Undocumented variable
     *
     * @var Renderer
     */
    private $renderer;

    public function setUp(): void
    {
        $this->renderer  = new Renderer();
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/Views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Hello World', $content);
    }
    public function testRenderTheDefaultPath()
    {
        $this->renderer->addPath(__DIR__ . '/Views');
        $content = $this->renderer->render('demo');
        $this->assertEquals('Hello World', $content);
    }
}
