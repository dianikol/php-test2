<?php

namespace Tests\Unit;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{

    /**
     * A Product Can Be Added To An Order
     */
    public function testAProductCanBeAddedToAnOrder()
    {
        $product = new Product('iPad', 1000);

        $order = new Order();

        $order->add($product);

        $this->assertCount(1, $order->getProducts());
    }

    /**
     * Multiple Products Can Be Added To An Order At Once
     */
    public function testMultipleProductsCanBeAddedToAnOrderAtOnce()
    {
        $product1 = new Product('iPad', 1000);
        $product2 = new Product('iPhone', 1000);
        $product3 = new Product('appleWatch', 100);

        $order = new Order();

        $order->addMany([$product1, $product2, $product3]);

        $this->assertCount(3, $order->getProducts());
    }

    /**
     * An Order Can Caalculate The Total Cost
     */
    public function testAnOrderCanCaalculateTheTotalCost()
    {
        $product1 = new Product('iPad', 1000);
        $product2 = new Product('iPhone', 1000);
        $product3 = new Product('appleWatch', 100);

        $order = new Order();

        $order->addMany([$product1, $product2, $product3]);

        $this->assertEquals(2100, $order->total());
    }


}
