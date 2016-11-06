<?php
namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_SimpleFunction;
use Twig_Loader_Filesystem;
use App\core\router\Router;

class Application
{
	public function run(Request $request)
	{
		// on charge notre moteur de template twig dans notre dossier templates
		$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
		$twig = new Twig_Environment($loader);
	 	$router = new Router($request,$twig);
	 	$this->router = $router;

		$function = new Twig_SimpleFunction('path', function ($name, $params = []) {
	 		return $this->router->generateUrl($name,$params);
		});	
		
		$twig->addFunction($function);
	 	
	 	require __DIR__ . '/config/routing.php';

		return $response;
	}
}
