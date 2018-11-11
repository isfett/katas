<?php
declare(strict_types=1);

namespace App\Tests;

use App\LeapYear;
use App\Tests\Storage\CsvFileIterator;
use PHPUnit\Framework\TestCase;

class LeapYearTest extends TestCase
{
    /**
     * @return iterable
     */
    public function csvProvider(): iterable
    {
        //https://docs.google.com/spreadsheets/d/16JFXr5FsDdUzda5JMLsZwm5EbYD-nzUUKG6HdFrHQ_w/edit#gid=0
        $storageDir = getcwd() . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Storage' . DIRECTORY_SEPARATOR;
        return new CsvFileIterator($storageDir . 'LeapYears.csv');
    }

    /**
     * @param int $year
     * @param bool $expectedResult
     * @return void
     *
     * @dataProvider csvProvider
     */
    public function testIsLeapYear(int $year, bool $expectedResult): void
    {
        $this->assertEquals($expectedResult, LeapYear::isLeapYear($year));
    }

    /**
     * @return void
     */
    public function testYearInLongLongFuture(): void
    {
        $this->assertTrue(LeapYear::isLeapYear(20000));
        $this->assertFalse(LeapYear::isLeapYear(20001));
    }

    /**
     * @return void
     */
    public function testThrowExceptionWhenBefore1582(): void
    {
        $this->expectException(\OutOfRangeException::class);
        $this->expectExceptionMessage('The Calender was not adopted yet!');

        LeapYear::isLeapYear(1581);
    }
}
