<?php

namespace App\core\controller;

use Symfony\Component\HttpFoundation\Request;
use App\core\router\Router;
use Twig_Environment;

class BaseController
{
	protected $request;
	protected $router;
	protected $twig;

	function __construct(Request $request, Router $router, Twig_Environment $twig)
	{
		$this->request = $request;
		$this->router = $router;
		$this->twig = $twig;
	}

	
}