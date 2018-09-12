<?php 

namespace Framework;

use Framework\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Register and match route
 */
class Router{

	/**
	 * [$router description]
	 * @var [type]
	 */
	private $router;


	public function __construct()
	{

		$this->router = new FastRouteRouter();
	}

	/**
	 * [get description]
	 * @param  string   $path     [description]
	 * @param  callable $callable [description]
	 * @param  string   $name     [description]
	 * @return [type]             [description]
	 */
	public function get(string $path, callable $callable, string $name)
	{

		$this->router->addRoute(new ZendRoute($path, $callable, ['GET'], $name));
	}

	/**
	 * [match description]
	 * @param  ServerRequestInterface $request [description]
	 * @return [Route|null]                          [description]
	 */
	public function match(ServerRequestInterface $request) {

		$result = $this->router->match($request);
		if($result->isSuccess())
		{
			return new Route(	
							$result->getMatchedRouteName(), 
							$result->getMatchedMiddleware(), 
							$result->getMatchedParams()
						);
		}

		return null;
	}	

	public function generateUri(string $name, array $params): ?string
	{

		return $this->router->generateUri($name, $params);

	}
}