<?php 

namespace Tests\Framework\Modules\ErroredModule;

class ErroredModule
{




	public function __construct	(\Framework\Router $route)
	{
		$router->get('/demo', function(){
			return new \StdClass();
		},'demo');
	}

}