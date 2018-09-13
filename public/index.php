<?php 

require '../vendor/autoload.php';

$renderer = new \Framework\Renderer();
$renderer->addPath(dirname(__DIR__). '/public/views');
 

$app = new Framework\App([
	App\Blog\BlogModule::class], 
	[
		'renderer' => $renderer
	]
 );

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
Http\Response\Send($response);