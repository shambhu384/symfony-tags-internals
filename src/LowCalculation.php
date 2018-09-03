<?php

namespace App;

use App\TaxCalculationInterface;

class LowCalculation implements TaxCalculationInterface
{
    public function apply(int $amount): int
    {
        if ( $amount < 150000) {
            throw new \InvalidArgumentException(sprintf("%s amount is not coming under taxable \n", $amount));
        }

        return $amount;
    }
}
