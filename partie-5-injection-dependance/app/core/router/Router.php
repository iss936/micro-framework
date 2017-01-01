<?php

namespace App\core\router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
	private $url; // url courante
	private $routes = []; // Tableau Routes
	private $routeNames = []; // Tableau clé[nom de la route] valeur [Object Route]
    private $request;
    private $twig;

	function __construct()
	{
        $request = Request::createFromGlobals();
		$this->url = $request->getPathInfo();
        $this->request = $request;
        // $this->twig = $twig;
	}

    /**
	 * get permet d'ajouter un objet Route 
	 * @param  String $goTo =  l'uri de destination
	 * @param  String $controllerAction =  une chaine de caractère contenant le nom du controller et son action séparer par ":"
	 * @param  String $name = nom de la route
	 * @return void
	 */
    public function add($goTo, $controllerAction, $name){

        $route = new Route($goTo, $controllerAction, $this->request, $this);
        $this->routes[] = $route;

        if(is_string($name)){
            $this->routeNames[$name] = $route;
        }
        else {
        	throw new \Exception("Saisir une chaîne de caractère pour le nom de votre route");
        }

        return $route;
    }

    /**
     * permet de lancer le router afin de trouver la route correspondant à l'url courante
     * @return Response
     */
    public function run(){
    	foreach ($this->routes as $oneRoute) {
    		if ($oneRoute->match($this->url)) {
            	return $oneRoute->executeControllerAction();
        	}
    	}
    	throw new \Exception('Route introuvable');
    }

    /**
     * génère une url à partir du nom de la route et de ses paramètres
     * @param  String $name
     * @param  array  $params
     * @return String url de destination
     */
    public function generateUrl($name, $params = []){
        if(!isset($this->routeNames[$name])){
            throw new \Exception('Aucune route trouvé avec ce nom');
        }
        return $this->routeNames[$name]->getRedirectUrl($params);
    }

    public function loadRoutes(){
        $router = $this;
        require __DIR__ . '/../../config/routing.php';
    }

}	

