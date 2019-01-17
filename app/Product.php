<?php
/**
 * Created by PhpStorm.
 * User: sakis
 * Date: 16/01/2019
 * Time: 15:38
 */

namespace App;


class Product
{
    protected $name;

    protected $cost;

    /**
     * Product constructor.
     * @param $name
     * @param $cost
     */
    public function __construct(string $name = '', float $cost = 0)
    {
        $this->name = $name;
        $this->cost = $cost;
    }


    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}