<?php
declare(strict_types=1);

namespace App;

class LeapYear implements LeapYearInterface
{
    /**
     * @param int $year
     * @return bool
     */
    public static function isLeapYear(int $year): bool
    {
        if ($year < 1582) { // calender was adopted
            throw new \OutOfRangeException('The Calender was not adopted yet!');
        }
        return $year % 400 === 0 || ($year % 4 === 0 && $year % 100 > 0);
    }
}
