<?php
declare(strict_types=1);

namespace App;

/**
 * Interface LeapYearInterface
 */
interface LeapYearInterface
{
    /**
     * @param int $year
     * @return bool
     */
    public static function isLeapYear(int $year): bool;
}
