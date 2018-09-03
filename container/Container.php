<?php

namespace Container;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class Container
{
    private $services;

    public function get($id): ?object
    {
        return $this->services[$id] ?? null;
    }

    public function load()
    {
        $service_file = 'services.yml';

        try {
            $configs = Yaml::parseFile($service_file);
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        foreach($configs['services'] as $id => $service) {
            $class = $service['class'];
            $args = [];
            if(isset($service['arguments'])) {
                $args = $service['arguments'];
            }
            $object = new $class(...$args);

            $this->services[$id] = $object;
        }

        // Tag services in Tax manager
        foreach($this->services as $id => $service) {
            if(isset($configs['services'][$id]['tags'])) {
                foreach($configs['services'][$id]['tags'] as $tag) {
                    list($service_id, $method) = explode('.', $tag);

                    // class tag method
                    $this->services[$service_id]->$method($service);
                }
            }
        }
    }

    public static function instance()
    {
        $container = new self();
        $container->load();
        return $container;
    }
}
