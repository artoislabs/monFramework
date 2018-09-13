<?php 

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use Framework\Renderer;

class RendererTest extends TestCase
{
	public function setUp()
	{
		$this->renderer = new Renderer();
	}

	public function testRenderTheRightPath()
	{

		$this->renderer->addPath('blog', __DIR__ . '/views');
		$content = $this->render('@blog/demo');

		$this->assertEquals('Salut les gens', $content);

	}

	public function testRenderTheDefaultPath()
	{

		$this->renderer->addPath('blog', __DIR__ . '/views');
		$content = $this->render('@blog/demo');

		$this->assertEquals('Salut les gens', $content);

	}

	public function testRenderWithParams()
	{

	 
		$content = $this->render('demoparams', ['nom' => 'Marc']);

		$this->assertEquals('Salut les Marc', $content);

	}

	public function testGlobalParamaters()
	{	
		$this->renderer->addGlobal('nom','Marc');
		$content = $this->render('demoparams', ['nom' => 'Marc']);

		$this->assertEquals('Salut Marc', $content);
	}
}