<?php
namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Application
{
	public function run(Request $request)
	{
		// on charge notre moteur de template twig dans notre dossier templates
		$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
		$twig = new Twig_Environment($loader);

	 	$uri = $request->getPathInfo();

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

		return Response::create($content);
	}
}