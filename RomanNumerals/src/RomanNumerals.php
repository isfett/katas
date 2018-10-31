<?php
declare(strict_types=1);

namespace App;

class RomanNumerals implements RomanNumeralsInterface
{
    /**
     * @var array
     */
    public static $romanMap = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I',
    ];

    /**
     * @param int $number
     * @return string
     */
    public static function numberToRoman(int $number): string
    {
        if ($number > 3000 || $number < 1) {
            throw new \OutOfRangeException('Number out of range. The romans couldn\'t calculate that much numbers!');
        }
        $output = '';

        foreach (self::$romanMap as $substrate => $romanChar) {
            while ($number >= $substrate) {
                $output .= $romanChar;
                $number -= $substrate;
            }
        }

        return $output;
    }

    /**
     * @param string $roman
     * @return int
     */
    public static function romanToNumber(string $roman): int
    {
        $result = 0;

        foreach (self::$romanMap as $addition => $romanChar) {
            while (\strpos($roman, $romanChar) === 0) {
                $result += $addition;
                $roman = \substr($roman, \strlen($romanChar));
            }
        }

        return $result;
    }
}
