<?php

namespace App;

use App\TaxCalculationInterface;

class HRATaxCalculation implements TaxCalculationInterface
{
    private $basicHRA = 95000;

    public function apply(int $amount): int
    {
        return $amount - $this->basicHRA;
    }
}
