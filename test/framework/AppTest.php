<?php 

namespace Test\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
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
		$this->assertEquals(301, $response->getStatusCode('Location'));
	}	

	public function testBlog()
	{

		$app = new App([ 
			BlogModule::class
		]);

		$request = new ServerRequest('GET', '/blog');
		$response = $app->run($request);
		
		$this->assertContains('<h1>Bienvenue sur mon blog</h1>', (string)$response->getBody());
		$this->assertEquals(200, $response->getStatusCode());



		$requestSingle = new ServerRequest('GET', '/blog/article-de-test');
		$responseSingle = $app->run($requestSingle);

		$this->assertContains('<h1>Bienvenue sur l\article article-de-test</h1>', (string)$responseSingle->getBody());

	}



	public function testError404()
	{

		$app = new App();

		$request = new ServerRequest('GET', '/azaza');
		$response = $app->run($request);

		$this->assertContains('<h1>Error 404</h1>', (string)$response->getBody());
		$this->assertEquals(404, $response->getStatusCode());
	}


	public function testThrowExceptionIfNoExceptionSent()
	{
		 $app = new App([ErroredModule::class]);

		 $request = new ServerRequest('GET', '/demo');
		 $this->expectException(\Exception::class);
		 $app->run($request);
	}

	public function testConvertStringModule()
	{
		 $app = new App([StirngModule::class]);

		 $request = new ServerRequest('GET', '/demo');
		 $this->expectException(\Exception::class);
		 $this->assertInstanceOf(ResponseInterface::class, $response);
		 $this->assertEquals('DEMO', (string)$response->getBody());
		 $app->run($request);
	}

}