<?php

namespace App;


class Formatter
{
    public function currencyAmount($input)
    {
        return round((float)$input, 2);
    }
}