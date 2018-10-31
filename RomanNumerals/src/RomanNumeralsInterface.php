<?php
declare(strict_types=1);

namespace App;

/**
 * Interface RomanNumeralsInterface
 */
interface RomanNumeralsInterface
{
    /**
     * @param int $number
     * @return string
     */
    public static function numberToRoman(int $number): string;

    /**
     * @param string $roman
     * @return int
     */
    public static function romanToNumber(string $roman): int;
}
