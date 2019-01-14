<?php

namespace App;


class Receipt
{
    private $taxPercentage = 0.20;

    private $formatter;

    /**
     * Receipt constructor.
     * @param $formatter
     */
    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }


    /**
     * @return float
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    /**
     * @param float $taxPercentage
     */
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
    }

    public function subTotal(array $items = [], $coupon = null)
    {
        if ( $coupon > 1.00 )
            throw new \BadMethodCallException('Coupon should be lesser or equal to 1.00');

        $sum = array_sum($items);

        if ( !is_null($coupon) )
            return $sum - ($sum * $coupon);

        return $sum;
    }

    public function calculateTax($amount)
    {
        return $this->formatter->currencyAmount($amount * $this->getTaxPercentage());
    }

    public function postTaxTotal($items, $coupon)
    {
        $subTotal = $this->subTotal($items, $coupon);
        $tax = $this->calculateTax($subTotal);

        return $subTotal + $tax;
    }
}