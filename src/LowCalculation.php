<?php

namespace App;

use App\TaxCalculationInterface;

class LowCalculation implements TaxCalculationInterface
{
    private $min_limit;

    public function __construct($min_limit) {
        $this->min_limit = $min_limit;
    }

    public function apply(int $amount): int
    {
        if ( $amount < $this->min_limit) {
            throw new \InvalidArgumentException(sprintf("%s amount is not coming under taxable \n", $amount));
        }

        return $amount;
    }
}
