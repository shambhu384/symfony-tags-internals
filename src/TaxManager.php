<?php

namespace App;

use App\TaxCalculationInterface;

class TaxManager
{
    private $calcultors = [];

    public function add(TaxCalculationInterface $calcultor)
    {
        $this->calcultors[] = $calcultor;
    }

    public function apply(int $amount)
    {
        if(count($this->calcultors) == 0) {
            throw new \LogicException("No tax calculator registered \n");
        }

        foreach($this->calcultors as $calcultor) {
            $amount = $calcultor->apply($amount);
        }

        echo sprintf("You taxable amount %s after tax deduction \n", $amount);
    }
}
