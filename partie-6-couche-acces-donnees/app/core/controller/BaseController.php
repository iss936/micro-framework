<?php

namespace App\core\controller;

use Symfony\Component\HttpFoundation\Request;
use App\core\router\Router;
use Twig_Environment;
use App\core\container\Container;

class BaseController
{
	protected $request;
	protected $router;
	protected $twig;
	protected $container;

	function __construct(Request $request, Router $router)
	{
	 	$container = Container::getInstance();
		$this->request = $request;
		$this->router = $router;
		$this->twig = $container->get('twig')->getTemplating();
		$this->db = $container->get('db');

	}

	
}