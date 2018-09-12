<?php 

namespace Test\Framework;

use PHPUnit\Framework\TestCase;
use Framework\Router;

class RouterTest extends TestCase
{

	public function setUp()
	{
		$this->router = new Router();

	}

	public function getTestMethodTrue()
	{
		$request = new Request('GET', '/blog');

		$this->router->get('/blog', function(){ return 'Hello!'; }, 'blog');
		$route = $this->router->match($request);
		$this->assertEquals('blog', $route->getName());
		$this->assertEquals('Hello!', call_user_func_array($route->getCallback(), [$request]));
	
	}

	public function getTestMethodFalse()
	{
		$request = new Request('GET', '/blog');

		$this->router->get('/bldsog', function(){ return 'Bye!'; }, 'blog');
		$route = $this->router->match($request);
		$this->assertEquals(null, $route);
		$this->assertEquals('Hello!', call_user_func_array($route->getCallback(), [$request]));
	}

	public function testGetMethodWithParameters()
	{
		$request = new ServerRequest('GET', '/blog/mon-slug-8');

		$this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function(){ return 'Bye!'; }, 'post.show');
		$route = $this->router->match($request);
		$this->assertEquals(null, $route);
		$this->assertEquals('Hello!', call_user_func_array($route->getCallback(), [$request]));
		$this->assertEquals(['slug' => 'mon-slug', 'id' => 8], $route->getParams());

		$route = $this->router->match(new ServerRequest('GET', '/blog/mon_slug-8'));
		$this->assertEquals(null, $route);

	}

	public function testGenerateUri()
	{

		$this->router->get('/blog', function(){ return 'azazaza'; }, 'posts');
		$this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function(){ return 'hello'; }, 'post.show');
		$uri = $this->router->generateUri('post.show', ['slug' => 'mon-article', 'id' => 18]);

		$this->assertEquals('/blog/mon-article-18', $uri);
	}

}

 ?>


