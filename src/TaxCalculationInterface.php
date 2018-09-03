<?php

namespace App;

interface TaxCalculationInterface
{
    public function apply(int $total): int;
}
