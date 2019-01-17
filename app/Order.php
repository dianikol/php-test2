<?php
/**
 * Created by PhpStorm.
 * User: sakis
 * Date: 16/01/2019
 * Time: 16:55
 */

namespace App;


class Order
{

    protected $products;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->products = [];
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }


    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function addMany(array $products = [])
    {
        if ( empty($products) )
            return;

        foreach ($products as $product) {
            $this->add($product);
        }
    }

    public function total()
    {
        $total = 0;

        $products = $this->getProducts();

        foreach ($products as $product)
        {
            $total += $product->getCost();
        }

        return $total;
    }

}