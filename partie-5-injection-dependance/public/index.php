<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require __DIR__.'/../vendor/autoload.php';

$session = new Session();
$session->start();

$app = new \App\Application();
$response = $app->run();
$response->send(); // On envoie la réponse