<?php
declare(strict_types=1);

namespace App\Tests;

use App\RomanNumerals;
use App\Tests\Storage\CsvFileIterator;
use PHPUnit\Framework\TestCase;

class RomanNumeralsTest extends TestCase
{
    /**
     * @return iterable
     */
    public function csvProvider(): iterable
    {
        // https://docs.google.com/spreadsheets/d/1RzSZ5vWv70DWBI4bbNnQcT7YKJFDHB9B_LNcKPI85ig/edit?ts=5bcf1c52#gid=542123158
        $storageDir = getcwd() . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Storage' . DIRECTORY_SEPARATOR;
        return new CsvFileIterator($storageDir . 'int2roman.csv');
    }

    /**
     * @param int $number
     * @param string $roman
     * @return void
     *
     * @dataProvider csvProvider
     */
    public function testNumberToRoman(int $number, string $roman): void
    {
        $this->assertEquals($roman, RomanNumerals::numberToRoman($number));
    }

    /**
     * @param int $number
     * @param string $roman
     * @return void
     *
     * @dataProvider csvProvider
     */
    public function testRomanToNumber(int $number, string $roman): void
    {
        $this->assertEquals($number, RomanNumerals::romanToNumber($roman));
    }

    /**
     * @return void
     */
    public function testNumberToRomanWillThrowExceptionOnZero(): void
    {
        $this->expectException(\OutOfRangeException::class);

        RomanNumerals::numberToRoman(0);
    }


    /**
     * @return void
     */
    public function testNumberToRomanWillThrowExceptionOnLowerZero(): void
    {
        $this->expectException(\OutOfRangeException::class);

        RomanNumerals::numberToRoman(-1);
    }


    /**
     * @return void
     */
    public function testNumberToRomanWillThrowExceptionOver3000(): void
    {
        $this->expectException(\OutOfRangeException::class);

        RomanNumerals::numberToRoman(3001);
    }
}
