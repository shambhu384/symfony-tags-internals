<?php

use Container\Container;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use App\DependencyInjection\TaxManagerCompilerPass;

require 'vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('services.yml');

$containerBuilder->addCompilerPass(new TaxManagerCompilerPass());
$containerBuilder->compile();


$manager = $containerBuilder->get('tax_manager');
try {
    $manager->apply($argv[1]);
} catch(Exception $e) {
    echo $e->getMessage();
}
