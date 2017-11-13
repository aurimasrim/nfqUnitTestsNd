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
        $strValue = '';
        $absValue = abs($number);
        switch (true) {
            case $absValue >= 999500:
                $strValue = number_format($number / 1000000, 2) . 'M';
                break;
            case $absValue >= 99950:
                $strValue = round($number / 1000) . 'K';
                break;
            case $absValue >= 1000:
                $strValue = number_format($number, 0, ',', ' ');
                break;
            default:
                if (ctype_digit($absValue)) {
                    $strValue = $number;
                } else {
                    $strValue = round($number, 2);
                }
        }

        return $strValue;
    }
}