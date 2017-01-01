<?php

namespace Controller;

use App\core\controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\core\container\Container;

class DefaultController extends BaseController
{
	public function index()
	{
		return Response::create($this->twig->render('index.html.twig'));
	}

	public function contact()
	{
		return Response::create($this->twig->render('contact.html.twig'));
	}
}	