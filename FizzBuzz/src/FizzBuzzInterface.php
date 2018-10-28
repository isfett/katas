<?php
declare(strict_types=1);

namespace App;

interface FizzBuzzInterface
{
    /**
     * @param int $input
     * @return string
     */
    public function process(int $input): string;
}
