<?php
declare(strict_types=1);

namespace App;

class FizzBuzz implements FizzBuzzInterface
{
    private const DIVISOR_FIZZ = 3;
    private const DIVISOR_BUZZ = 5;

    private const WORD_FIZZ = 'Fizz';
    private const WORD_BUZZ = 'Buzz';

    /**
     * @param int $input
     * @return string
     */
    public function process(int $input): string
    {
        $output = '';
        if ($this->divisableByThree($input)) {
            $output .= self::WORD_FIZZ;
        }
        if ($this->divisableByFive($input)) {
            $output .= self::WORD_BUZZ;
        }
        return $output ?: (string)$input;
    }

    /**
     * @param int $input
     * @return bool
     */
    private function divisableByThree(int $input): bool
    {
        return $this->divisableBy($input, self::DIVISOR_FIZZ);
    }

    /**
     * @param int $input
     * @return bool
     */
    private function divisableByFive(int $input): bool
    {
        return $this->divisableBy($input, self::DIVISOR_BUZZ);
    }

    /**
     * @param int $input
     * @param int $divisor
     * @return bool
     */
    private function divisableBy(int $input, int $divisor): bool
    {
        return $input % $divisor === 0;
    }
}
