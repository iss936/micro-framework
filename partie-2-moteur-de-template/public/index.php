<?php
require __DIR__.'/../vendor/autoload.php'; // On accède à l'autoload de composer afin de pouvoir instancier les classes des différentes librairies installés
$username = "Issa";
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader); 
// echo $twig->render('front/index.html', ['username' => $username]); si on souhaite passer a la vue des variables php //
echo $twig->render('index.html.twig'); 

?>

