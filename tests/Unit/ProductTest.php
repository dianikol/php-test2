<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    protected $product;

    protected function setUp()
    {
        $this->product = new Product();
    }

    protected function tearDown()
    {
        unset($this->product);
    }


    /**
     * @test
     */
    public function product_has_name()
    {
        $this->product->setName('macbook');

        $this->assertEquals('macbook', $this->product->getName());
    }

    /**
     * @test
     */
    public function product_has_cost()
    {
        $this->product->setCost(19);

        $this->assertEquals(19, $this->product->getCost());
    }


}
