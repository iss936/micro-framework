<?php

namespace App\core\db;

use App\core\container\Container;

class ParentSql{
    
    protected $db;

    function __construct()
    {
        $container = Container::getInstance();
        $this->db = $container->get('db');
    }
    
}