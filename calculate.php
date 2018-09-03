<?php


use App\TaxManager;
use App\LowCalculation;
use App\HRATaxCalculation;

require 'vendor/autoload.php';

$manager = new TaxManager();

$manager->add(new LowCalculation());
$manager->add(new HRATaxCalculation());

try {
    $manager->apply($argv[1]);
} catch(Exception $e) {
    echo $e->getMessage();
}
