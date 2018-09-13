<?php 

namespace Framework;

class Renderer{

	/**
	 * 
	 */
	const DEFAULT_NAMESPACE = '__MAIN';
	/**
	 * [$paths description]
	 * @var array
	 */
	private $paths = [];

	/**
	 * [addPath description]
	 * @param string      $namespace [description]
	 * @param string|null $path      [description]
	 */
	
	private $globals = [];

	public function addPath(string $namespace, ?string $path = null) : void
	{	
		if(is_null($path)){
			$this->paths[self::DEFAULT_NAMESPACE] = $namespace;
		 }else{
			$this->paths[$namespace] = $path;
		}
	}

	/**
	 * [render description]
	 * @param  string $view   [description]
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
	public function render(string $view, array $params = []): string 
	{	 
		 
		if($this->hasNamespace($view))
		{
			 
			$path = $this->replaceNamespace($view) . '.php';
		}else{

			$path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
		}

		 

		ob_start();
		extract($this->globals);
		extract($params);
		$renderer = $this;
		require ($path);
		return ob_get_clean();
		
	}

	/**
	 * Permet d'ajouter une variable globale à toute les vues
	 * @param string $key   [description]
	 * @param [type] $value [description]
	 */
	public function addGlobal(string $key, $value) : void
	{
		$this->globals[$key] = $value;
	}

	/**
	 * [hasNamespace description]
	 * @param  string  $view [description]
	 * @return boolean       [description]
	 */
	private function hasNamespace(string $view): bool
	{
		return $view[0] === '@';
	}

	
	/**
	 * [getNamespace description]
	 * @param  [type] $view [description]
	 * @return [type]       [description]
	 */
	private function getNamespace(string $view) : string
	{
		return substr($view, 1, strpos($view, '/' )-1);
	}

	/**
	 * [replaceNamespace description]
	 * @param  [type] $view [description]
	 * @return [type]       [description]
	 */
	private function replaceNamespace(string $view): string
	{
		 
		$namespace = $this->getNamespace($view);
	 
		return str_replace('@'. $namespace, $this->paths[$namespace], $view);
	}
}