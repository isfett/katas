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
     * @return array
     */
    public function romanAdditionProvider(): array
    {
        return [
            ['X', 'X', 'XX'],
            ['IV', 'VI', 'X'],
            ['I', 'III', 'IV'],
            ['DXC', 'MCDXI', 'MMI'], // 590 + 1411 = 2001
        ];
    }


    /**
     * @return array
     */
    public function romanSubtractionProvider(): array
    {
        return [
            ['X', 'V', 'V'],
            ['VI', 'IV', 'II'],
            ['IX', 'III', 'VI'],
            ['MCDXI', 'DXC', 'DCCCXXI'], // 1411 - 590 = 821
        ];
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

    /**
     * @param string $roman1
     * @param string $roman2
     * @param string $result
     * @return void
     *
     * @dataProvider romanAdditionProvider
     */
    public function testAddRomanToRoman(string $roman1, string $roman2, string $result): void
    {
        $this->assertEquals($result, RomanNumerals::additionRomanToRoman($roman1, $roman2));
    }

    /**
     * @return void
     */
    public function testAddRomanToRomanWillThrowExceptionWhenResultIsOver3000(): void
    {
        $this->expectException(\OutOfRangeException::class);

        RomanNumerals::additionRomanToRoman('MM','MM'); // 4000
    }

    /**
     * @param string $roman1
     * @param string $roman2
     * @param string $result
     * @return void
     *
     * @dataProvider romanSubtractionProvider
     */
    public function testSubRomanToRoman(string $roman1, string $roman2, string $result): void
    {
        $this->assertEquals($result, RomanNumerals::subtractionRomanToRoman($roman1, $roman2));
    }

    /**
     * @return void
     */
    public function testSubRomanToRomanWillThrowExceptionWhenResultIsEqualsZero(): void
    {
        $this->expectException(\OutOfRangeException::class);

        RomanNumerals::subtractionRomanToRoman('MM','MM'); // 0
    }

    /**
     * @return void
     */
    public function testSubRomanToRomanWillThrowExceptionWhenResultIsEqualsLowerThanZero(): void
    {
        $this->expectException(\OutOfRangeException::class);

        RomanNumerals::subtractionRomanToRoman('MM','MMI'); // -1
    }
}
