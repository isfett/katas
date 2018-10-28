<?php
declare(strict_types=1);

namespace App\Tests;

use App\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /** @var FizzBuzz */
    private $fizzBuzz;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->fizzBuzz = new FizzBuzz();
    }

    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            'one' => ['1', 1],
            'two' => ['2', 2],
            'Fizz' => ['Fizz', 3],
            'four' => ['4', 4],
            'Buzz' => ['Buzz', 5],
            'Fizz on six' => ['Fizz', 6],
            'seven' => ['7', 7],
            'eight' => ['8', 8],
            'Fizz on nine' => ['Fizz', 9],
            'Buzz on ten' => ['Buzz', 10],
            'eleven' => ['11', 11],
            'Fizz on twelve' => ['Fizz', 12],
            'thirteen' => ['13', 13],
            'fourteen' => ['14', 14],
            'FizzBuzz' => ['FizzBuzz', 15],
            'Fizz on 18' => ['Fizz', 18],
            'Buzz on 20' => ['Buzz', 20],
            'Buzz on 25' => ['Buzz', 25],
            'FizzBuzz on 30' => ['FizzBuzz', 30],
            'FizzBuzz on 45' => ['FizzBuzz', 45],
            'FizzBuzz on 60' => ['FizzBuzz', 60],
        ];
    }

    /**
     * @param string $expectedResult
     * @param int $input
     * @return void
     *
     * @dataProvider provider
     */
    public function testProcess(string $expectedResult, int $input): void
    {
        $this->assertEquals($expectedResult, $this->fizzBuzz->process($input));
    }
}
