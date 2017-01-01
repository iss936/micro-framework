<?php

namespace Controller;

use App\core\controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends BaseController
{

	public function categoriesList()
	{
		return Response::create($this->twig->render('categorie/list.html.twig', array()));
	}
}	