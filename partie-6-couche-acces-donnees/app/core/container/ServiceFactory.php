<?php

namespace App\core\container;
use Symfony\Component\Yaml\Yaml;

class ServiceFactory
{
    /**
     * @var array
     */
    private $serviceList;

    /**
     * @var config yml file with the services
     */
    private $ymlConfigFile;

    /**
     * @param string $configFile
     */
    public function __construct($configFile)
    {
        $this->ymlConfigFile = $configFile;
        // load list of service from default_services.yml
        $this->defaultConfigFile = __DIR__."/../default_services.yml";

        $this->loadServiceList();
    }

    /**
     * @param \stdClass $serviceData
     * @param Container $container
     *
     * @return array
     */
    private function getArgs(\stdClass $serviceData, Container $container)
    {
        $args = [];
        if (isset($serviceData->arguments)) {
            foreach ($serviceData->arguments as $arg) {
                // use the container to find dependencies
                $args[] = $container->get($arg);
            }
        }

        return $args;
    }

    /**
     * Use reflection to instantiate new objects
     *
     * @param           $id
     * @param Container $container
     *
     * @return mixed - any object
     */
    private function instantiateService($id, Container $container)
    {
        $serviceData = $this->serviceList[$id];

        $reflector = new \ReflectionClass($serviceData->class);
        
        return $reflector->newInstanceArgs($this->getArgs($serviceData, $container));
    }

    /**
     * [loadYmlFile description]
     * @return Array of services
     */
    private function loadYmlFile()
    {
        $string = file_get_contents($this->ymlConfigFile);
        $tab = Yaml::parse($string);

        return $tab;
    }

    /**
     * [loadDefaultServiceFile description]
     * @return Array of default services
     */
    private function loadDefaultServiceFile() {
        $string = file_get_contents($this->defaultConfigFile);
        $tab = Yaml::parse($string);

        return $tab;
    }

    /**
     * [loadServiceList description]
     * @return Array merge of services and default services
     */
    private function loadServiceList()
    {
        $defaultServicestab = $this->loadDefaultServiceFile();
        $ymlServicesTab = $this->loadYmlFile();
        $mergeServices = array_merge_recursive($defaultServicestab, $ymlServicesTab);

        $ymlObjects = json_decode(json_encode($mergeServices));
      
        foreach ($ymlObjects  as $serviceObjects => $values) {
            foreach ($values as $oneServiceKey => $objectSubKey) {
                $this->serviceList[$oneServiceKey] = $objectSubKey;
            }
            
        }
    }

    /**
     * @param string    $id - a known id key
     * @param Container $container
     *
     * @return mixed - a registered service
     *
     * @throws \InvalidArgumentException
     */
    public function create($id, Container $container)
    {
        if (!isset($this->serviceList[$id])) {
            throw new \InvalidArgumentException("'$id' est un service inconnu");
        }

        return $this->instantiateService($id, $container);
    }
}
