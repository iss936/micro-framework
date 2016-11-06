<?php

namespace App\config;

$router->add('/', "Default:index","esgi_main");
$router->add('/articles/modifier/:id', "Article:modifier","esgi_edit_article");
$router->add('/articles/liste', "Article:postsList","esgi_list_articles");
$router->add('/contact', "Default:contact","esgi_contact");
$router->add('/categories', "Categorie:categoriesList", "esgi_list_categories");

// set la reponse du controller afin que le front controller puisse envoyer la reponse.
$response = $router->run();
