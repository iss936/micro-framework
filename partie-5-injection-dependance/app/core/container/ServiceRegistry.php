<?php

namespace App\core\container;

class ServiceRegistry
{
    private $services = [];

    public function get($id)
    {
        if (!isset($this->services[$id])) {
            return null;
        }

        return $this->services[$id];
    }

    public function add($id, $service)
    {
        $this->services[$id] = $service;
    }
}
