<?php

namespace prgTW\AdventOfCode\Impl\Year2023;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day1 extends AbstractDayChallenge
{
    private array $digits = [
        '1'     => 1,
        '2'     => 2,
        '3'     => 3,
        '4'     => 4,
        '5'     => 5,
        '6'     => 6,
        '7'     => 7,
        '8'     => 8,
        '9'     => 9,
        'one'   => 1,
        'two'   => 2,
        'three' => 3,
        'four'  => 4,
        'five'  => 5,
        'six'   => 6,
        'seven' => 7,
        'eight' => 8,
        'nine'  => 9,
    ];

    public function part1(): int
    {
        $sum = 0;
        foreach (explode("\n", $this->input) as $line) {
            $digits = preg_replace('/[^1-9]/', '', $line);
            $first  = $digits[0];
            $last   = $digits[strlen($digits) - 1];
            $sum    += (int)"{$first}{$last}";
        }

        return $sum;
    }

    public function part2(): int
    {
        $sum = 0;

        foreach (explode("\n", $this->input) as $line) {
            $firstPos = $lastPos = $firstDigit = $lastDigit = null;
            foreach ($this->digits as $str => $digit) {
                $fromLeftPos = strpos($line, $str);
                if (false !== $fromLeftPos && $fromLeftPos < ($firstPos ?? PHP_INT_MAX)) {
                    $firstPos   = $fromLeftPos;
                    $firstDigit = $digit;
                }
            }
            foreach ($this->digits as $str => $digit) {
                $fromRightPos = strrpos($line, $str);
                if (false !== $fromRightPos && $fromRightPos > ($lastPos ?? PHP_INT_MIN)) {
                    $lastPos   = $fromRightPos;
                    $lastDigit = $digit;
                }
            }

            $sum += (int)"{$firstDigit}{$lastDigit}";
        }

        return $sum;
    }
}
