<?php
namespace App;

use App\core\container\Container;

class Application
{
	public function run()
	{

	 	$container = Container::getInstance();
	 	$router = $container->get('router');

	 	require __DIR__ . '/config/routing.php';

	 	// set la reponse du controller afin que le front controller puisse envoyer la reponse.
		$response = $router->run();

		return $response;
	}
}
