<?php

namespace App\core\container;

/**
 * The dependency injection container
 *
 * @author Issa Soumare
 */
class Container
{
    private static $instance;

    /**
     * @var ServiceRegistry
     */
    private $serviceRegistry;

    /**
     * path to services yml file containing the services
     */
    private $factory;

    /**
     * Controls circular dependency
     * @var array
     */
    private $servicesCreating = [];

    /**
     * @param ServiceRegistry $serviceRegistry
     */
    private function __construct()
    {
        $this->serviceRegistry = new ServiceRegistry();
        $pathServiceYml = __DIR__."/../../config/services.yml";
        $this->factory    = new ServiceFactory($pathServiceYml);
    }

    /* .... */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Container();
        }

        return self::$instance;
    }

    /**
     * Gets the instance via lazy initialization (created on first usage)
     *
     * @param $id
     *
     * @throws DependencyInjectionException
     *
     * @return a registered service
     */
    public function get($id)
    {
        $service = $this->serviceRegistry->get($id);

        if (is_null($service)) {

            if (isset($this->servicesCreating[$id])) {
                $msg = 'Circular dependency detected: ' . implode(' => ', array_keys($this->servicesCreating)) . " => {$id}";
                throw new DependencyInjectionException($msg);
            }
            // remmember ids called
            $this->servicesCreating[$id] = true;
            // pass the container to force only one instantiation per class
            $service = $this->factory->create($id, $this);

            unset($this->servicesCreating[$id]);

            $this->serviceRegistry->add($id, $service);
        }
        
        return $service;
    }


}
