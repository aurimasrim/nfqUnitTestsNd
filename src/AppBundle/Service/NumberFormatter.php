<?php
/**
 * Created by PhpStorm.
 * User: aurimas
 * Date: 17.11.12
 * Time: 23.59
 */

namespace AppBundle\Service;

class NumberFormatter
{
    public function format(float $number): string
    {
        $absValue = abs($number);
        switch (true) {
            case $absValue >= 999500:
                return number_format($number / 1000000, 2) . 'M';
            case $absValue >= 99950:
                return round($number / 1000) . 'K';
            case $absValue >= 1000:
                return number_format($number, 0, ',', ' ');
            default:
                $absValue = (string)round($absValue, 2);
                if (ctype_digit($absValue)) {
                    return number_format($number, 0, ',', ' ');
                }
                return round($number, 2);
        }
    }
}
