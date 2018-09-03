<?php

namespace App;

use App\TaxCalculationInterface;

class TaxPPFDeduction implements TaxCalculationInterface
{
    private $intrest;

    public function __construct(int $intrest)
    {
        $this->intrest = $intrest;
    }

    public function apply(int $amount): int
    {
        $rate = $amount / 100 * $this->intrest;

        return $amount - $rate;
    }
}
