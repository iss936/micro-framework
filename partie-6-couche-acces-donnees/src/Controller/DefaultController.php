<?php

namespace Controller;

use App\core\controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sql\UserSql;
class DefaultController extends BaseController
{
	public function index()
	{
		
        /*$users = new UserSql();
        var_dump($user->findAll());
        die();*/

		return Response::create($this->twig->render('index.html.twig'));
	}

	public function contact()
	{
		return Response::create($this->twig->render('contact.html.twig'));
	}
}	