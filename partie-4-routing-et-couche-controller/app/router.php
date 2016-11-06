<?php
namespace App;

class Router
{
	private $url;
	private $routes = []; // Tableau de routes

	// url 
	function __construct($url)
	{
		$this->url = $url;
	}

	public function get($path, $callable){
	    $route = new Route($path, $callable);
	    $this->routes[] = $route;
	    return $route; // On retourne la route
	}
	public function findRoute($uri)
	{
		switch ($uri) {
	 		case '/':
	 			$content = $twig->render('index.html.twig');
	 			break;
	 		case '/contact':
				$content = $twig->render('contact.html.twig');
				break;
			case '/articles':
				$content = $twig->render('article/list.html.twig');
				break;
			case '/categories':
				$content = $twig->render('categorie/list.html.twig');
				break;
	 		default:
	 			return Response::create($twig->render('exception/404.html.twig'), 404);
	 			break;
	 	}
	}

}	

