<?php

namespace Tests\Unit;

use App\Formatter;
use App\Receipt;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReceiptTest extends TestCase
{
    private $receipt;

    protected function setUp()
    {
        $this->receipt = new Receipt(new Formatter());
    }

    protected function tearDown()
    {
        unset($this->receipt);
    }

    /**
     * Calculate Correct Sub Total
     *
     * @@dataProvider provideSubTotal
     */
    public function testCalculateCorrectSubTotal($items, $expected)
    {
        // inputs
        $coupon = null;

        // Trigger the method
        $actual = $this->receipt->subTotal($items, $coupon);

        // Assert
        $message = 'Expects ' . $expected;

        $this->assertEquals($expected, $actual, $message);
    }

    public function provideSubTotal()
    {
        return [
            [[], 0],
            [[1,2,5,8], 16],
            [[-1,2,5,8], 14],
        ];
    }

    /**
     * Calculate Correct SubTotal With Coupon
     */
    public function testCalculateCorrectSubTotalWithCoupon()
    {
        // inputs
        $input = [6,2,2];
        $coupon = 0.20;

        // Trigger the method
        $actual = $this->receipt->subTotal($input, $coupon);

        // Assert
        $expected = 8;
        $message = 'Expects 8';

        $this->assertEquals($expected, $actual, $message);
    }

    /**
     * Calculate Correct SubTotal With Coupon
     */
    public function testCalculateCorrectSubTotalWithException()
    {
        // inputs
        $input = [6,2,2];
        $coupon = 1.20;

        // Trigger the method with exception
        $this->expectException('BadMethodCallException');

        $actual = $this->receipt->subTotal($input, $coupon);
    }

    /**
     * Claculate Correct Tax
     */
    public function testClaculateCorrectTax()
    {
        // inputs
        $amount = 10.00;
        $this->receipt->setTaxPercentage(0.10);

        // Trigger the method
        $actual = $this->receipt->calculateTax($amount);

        // Assert
        $expected = 1.00;
        $message = 'Tax should be 1.0';

        $this->assertEquals($expected, $actual, $message);
    }

    /**
     * Post Tax SubTotal
     */
    public function testPostTaxSubTotal()
    {
        // Inputs
        $items = [1,2,5,8];
        $taxPercenrage = 0.20;
        $coupon = null;

        // Mocks
        $receipt = $this->getMockBuilder(Receipt::class)
                        ->setConstructorArgs([new Formatter()])
                        ->setMethods(['subTotal', 'calculateTax'])
                        ->getMock();

        $receipt->expects($this->once())
                ->method('subTotal')
                ->with($items, $coupon)
                ->will($this->returnValue(10.00));
        $receipt->expects($this->once())
                ->method('calculateTax')
                ->with(10.00)
                ->will($this->returnValue(1.00));

        // Trigger the method
        $actual = $receipt->postTaxTotal($items, $coupon);

        // Assert
        $expected = 11.00;
        $message = 'Tax should be 1.0';

        $this->assertEquals($expected, $actual, $message);
    }
}
