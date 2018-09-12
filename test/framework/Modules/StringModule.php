<?php 

namespace Tests\Framework\Modules\StringModule;

class StringModule
{




	public function __construct	(\Framework\Router $route)
	{
		$router->get('/demo', function(){
			return 'DEMO';
		},'demo');
	}

}