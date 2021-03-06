<?php
/**
 * Created by PhpStorm.
 * User: aurimas
 * Date: 17.11.12
 * Time: 23.59
 */

namespace Tests\AppBundle\Service;

use AppBundle\Service\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    /**
     * @dataProvider formattedNumberProvider
     * @dataProvider boundaryNumberProvider
     * @dataProvider negativeBoundaryNumberProvider
     */
    public function testFormat(float $input, string $expected)
    {
        $numberFormatter = new NumberFormatter();
        $this->assertEquals($expected, $numberFormatter->format($input));
    }

    public function testFormatInvalid()
    {
        $numberFormatter = new NumberFormatter();
        $this->expectException(\TypeError::class);
        $numberFormatter->format('a');
    }

    public function formattedNumberProvider()
    {
        return [
            [0, '0'],
            [2835779, '2.84M'],
            [535216, '535K'],
            [99950, '100K'],
            [27533.78, '27 534'],
            [533.1, '533.10'],
            [66.6666, '66.67'],
            [12.00, '12'],
            [-123654.89, '-124K'],
            [0.0000001, '0'],
            [0.005, '0.01'],
        ];
    }

    public function boundaryNumberProvider()
    {
        return [
            [999501, '1.00M'],
            [999500, '1.00M'],
            [999499.99999, '999K'],
            [999499, '999K'],
            [99951, '100K'],
            [99950, '100K'],
            [99949.99999, '99 950'],
            [99949, '99 949'],
            [1001, '1 001'],
            [1000, '1 000'],
            [999.99999, '1 000'],
            [999, '999'],
            [1, '1']
        ];
    }

    public function negativeBoundaryNumberProvider()
    {
        return [
            [-999501, '-1.00M'],
            [-999500, '-1.00M'],
            [-999499.99999, '-999K'],
            [-999499, '-999K'],
            [-99951, '-100K'],
            [-99950, '-100K'],
            [-99949.99999, '-99 950'],
            [-99949, '-99 949'],
            [-1001, '-1 001'],
            [-1000, '-1 000'],
            [-999.99999, '-1 000'],
            [-999, '-999'],
            [-1, '-1']
        ];
    }
}