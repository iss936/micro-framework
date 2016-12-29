<?php

namespace App\core\router;

class Route {

    private $goTo;
    private $controllerAction;
    private $matches = []; // valeur des paramètres
    private $params = []; // pour les paramètres contenant des regex

    public function __construct($goTo, $controllerAction, $request, $router, $twig){
        $this->goTo = trim($goTo, '/');
        $this->controllerAction = $controllerAction;
        $this->request = $request;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * permet d'ajouter un param à une route avec une regex de son choix
     * @param  String $param
     * @param  String $regex
     * @return  this
     */
    public function with($param, $regex){
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    public function match($url){
        $url = trim($url, '/'); // on supprime de l'url tous les "/"
        $goTo = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->goTo); // on cherche dans goTo ":uneValeur" autant de fois qu'il y'en a et on la remplace par $this->paramMatch
        $regex = "#^$goTo$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }

        array_shift($matches); // on retire la première valeur du tableau qui est $url
        $this->matches = $matches;
        return true;
    }

    private function paramMatch($match){
        if(isset($this->params[$match[1]])){
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * Exécute l'action du controller en fonction de la variable $this->controllerAction
     * @return response du controller
     */
    public function executeControllerAction(){
        if(is_string($this->controllerAction)){
            $params = explode(':', $this->controllerAction); // on récupère un tableau indice 0 = controller indice 1 = action
            $controller = "Controller\\" . $params[0] . "Controller";
            $controller = new $controller($this->request, $this->router, $this->twig);
            return call_user_func_array([$controller, $params[1]], $this->matches);
        } else {
            return call_user_func_array($this->controllerAction, $this->matches);
        }
    }

    /**
     * getRedirectUrl
     * @param  String $params
     * @return url de redirection
     */
    public function getRedirectUrl($params){
        $goTo = '/'.$this->goTo;
        
        // remplacement des paramètres de la route par leur valeur
        foreach($params as $key => $value){
            if (!preg_match("#/:$key#", $goTo)) {
                throw new \Exception("Error ". $key. " not exist");
            }
            $goTo = str_replace(":$key", $value, $goTo);
        }
        return $goTo;
    }

}