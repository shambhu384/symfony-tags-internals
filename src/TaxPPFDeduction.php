<?php

namespace App;

use App\TaxCalculationInterface;

class TaxPPFDeduction implements TaxCalculationInterface
{
    private $intrest;
    private $plan;

    public function __construct(int $intrest, int $plan)
    {
        $this->intrest = $intrest;
        $this->plan = $plan;
    }

    public function apply(int $amount): int
    {
        if($this->plan > 2000000) {
            $amount = $amount / 100 * $this->intrest;
        } else {
            $rate = $amount / 100 * $this->intrest;
            $amount = ($amount - $rate) + 1400;
        }

        return $amount;
    }
}
