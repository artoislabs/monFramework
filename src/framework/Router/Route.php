<?php 

namespace Framework\Router;

/**
 *
 * Class Route
 * Represent a Matched route
 */
class Route{

	/**
	 * [$name description]
	 * @var [type]
	 */
	private $name;

	/**
	 * [$callback description]
	 * @var [type]
	 */
	private $callback;

	/**
	 * [$parameters description]
	 * @var [type]
	 */
	private $parameters;

	/**
	 * [__construct description]
	 * @param string   $name       [description]
	 * @param callable $callback   [description]
	 * @param array    $parameters [description]
	 */
	public function __construct(string $name, callable $callback, array $parameters )
	{

		$this->name = $name;
		$this->callback = $callback;
		$this->parameters = $parameters;
	}

	/**
	 * 
	 * 
	 * @return [string] [description]
	 */
	public function getName() : string {

		return $this->name;
	}

	/**
	 * [getCallback description]
	 * @return [type] [description]
	 */
	public function getCallback(): callable {

		return $this->callback;
	}

	/**
	 * Get the url parameters
	 * @return [type] [description]
	 */
	public function getParams(): array {

		return $this->parameters;
	}
}