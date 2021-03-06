<?php  

namespace Framework;

use Framework\Router;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Blog\BlogModule;

class App{

	/**
	 * Liste of modules
	 * @var array
	 */
	private $modules = [] ;

	/**
	 * Router
	 * 
	 */
	private $router;
	/**
	 *App constructor
	 * @param string[] $modules [Liste des modules à charger]
	 */
	public function __construct(array $modules = [], array $dependencies = [])
	{

		$this->router = new Router();

		if(array_key_exists('renderer', $dependencies))
		{
			$dependencies['renderer']->addGlobal('router', $this->router);
		}
		
		foreach ($modules as $module) {
			$this->module[] = new $module($this->router, $dependencies['renderer']);
		}
	}

	public function run (ServerRequestInterface $request) : ResponseInterface{

		$uri = $request->getUri()->getPath();
		if(!empty($uri) && $uri[-1] == '/'){
			return $response = (new Response())
							->withStatus(301)
							->withHeader('Location', substr($uri, 0, -1));
		}

		  
		$route = $this->router->match($request);

		if(is_null($route))
		{
			return new Response(404, [], '<h1>Erreur 404</h1>');
		} 

		$params = $route->getParams();
		$request = array_reduce(array_keys($params), function ($request, $key) use ($params){
				return $request->withAttribute($key, $params[$key]);
		}, $request);

		$response = call_user_func_array($route->getCallback(), [$request]);
		 
		if(is_string($response))
		{
			return new Response(200, [], $response);
		}elseif($response instanceof ResponseInterface)
		{
			return $reponse;
		}else{
			throw new \Exception("The reponse is not an instance of ResponseInterface or a string", 1);
			
		}
	}
}
