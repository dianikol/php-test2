<?php

namespace Tests\Unit;

use App\Formatter;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatterTest extends TestCase
{
    private $formatter;

    protected function setUp()
    {
        $this->formatter = new Formatter();
    }

    protected function tearDown()
    {
        unset($this->formatter);
    }

    /**
     * Currency Amount
     *
     * @dataProvider providecurrencyAmount
     */
    public function testCurrencyAmount($input, $expected, $msg)
    {
        // Trigger the method
        $actual = $this->formatter->currencyAmount($input);

        // Assert
        $this->assertSame($expected, $actual, $msg);
    }

    public function providecurrencyAmount()
    {
        return [
            [1, 1.00, '1 should be transformed into 1.00'],
            [1.1, 1.10, '1.1 should be transformed into 1.10'],
            [1.11, 1.11, '1.11 should stay 1.11'],
            [1.111, 1.11, '1.111 should be transformed into 1.11'],
            [-1.111, -1.11, '-1.111 should be transformed into -1.11'],
            ['a1', 0.00, 'strings should be transformed into 0.00'],
        ];
    }
}
