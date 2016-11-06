<?php

namespace Esgi\Controller;

use App\core\controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ArticleController extends BaseController
{

	public function postsList() {
		return Response::create($this->twig->render('article/list.html.twig'));
	}

	public function modifier($id)
	{
		if ($id > 10) {
			return new RedirectResponse($this->router->generateUrl('esgi_list_articles'));
		}
		return Response::create($this->twig->render('article/update.html.twig', array('id' => $id)));
	}
}	