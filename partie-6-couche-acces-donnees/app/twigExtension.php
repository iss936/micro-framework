<?php
namespace App;

use Twig_Loader_Filesystem;
use Twig_Environment;
use App\core\router\Router;
use Twig_SimpleFunction;

class TwigExtension 
{
	private $twigLoader;
	private $router;
	private $twig;

	public function __construct(Router $router) {

		$this->twigLoader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
		$this->twig = new Twig_Environment($this->twigLoader);
		$this->router = $router;		
		$this->loadFunctions();
		$this->loadFilters();
	}

	private function loadFunctions()
	{
		$this->router->loadRoutes();

		$function = new Twig_SimpleFunction('path', function ($name, $params = []) {
	 		return $this->router->generateUrl($name,$params);
		});
		
		$this->twig->addFunction($function);
	}

	private function loadFilters()
	{
	}

	public function getTemplating() {
		return $this->twig;
	}
}
