<?php

use Container\Container;

require 'vendor/autoload.php';

$container = Container::instance();

$manager = $container->get('tax_manager');

try {
    $manager->apply($argv[1]);
} catch(Exception $e) {
    echo $e->getMessage();
}
