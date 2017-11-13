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
     */
    public function testFormat(float $input, string $expected)
    {
        $numberFormatter = new NumberFormatter();
        $this->assertEquals($expected, $numberFormatter->format($input));
    }

    public function formattedNumberProvider()
    {
        return [
            [0, '0'],
            [2835779, '2.84M'],
            [535216, '535K'],
            [99950, '100K'],
            [27533.78, '27534'],
            [533.1, '533.10'],
            [66.6666, '66.67'],
            [12.00, '12'],
            [-123654.89, '-124K']
        ];
    }
}