<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require __DIR__.'/../vendor/autoload.php';

$session = new Session();
$session->start();

$request = Request::createFromGlobals(); // on instancie un une nouvelle requête http avec les valeurs des variables PHP superglobals 

$app = new \App\Application();
$response = $app->run($request);
$response->send(); // On envoie la réponse
