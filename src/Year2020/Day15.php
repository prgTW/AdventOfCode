<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Year2020;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day15 extends AbstractDayChallenge
{
    /** @var array<string> */
    private array $startingNumbers;

    /** @noinspection PhpMissingParentConstructorInspection */
    public function __construct(string $input)
    {
        $this->startingNumbers = array_map(static fn(string $number) => (int)$number, explode(',', $input));
    }

    public function part1(int $iteration): int
    {
        $last = [];
        foreach ($this->startingNumbers as $turn => $startingNumber) {
            $last[$startingNumber] = $turn;
        }

        $currentNumber = end($this->startingNumbers);
        for ($turn = count($this->startingNumbers) - 1; $turn < $iteration; ++$turn) {
            $previousNumber = $currentNumber;
            if (!isset($last[$currentNumber])) {
                $currentNumber = 0;
            } else {
                $currentNumber = $turn - $last[$currentNumber];
            }
            $last[$previousNumber] = $turn;
        }

        return $previousNumber;
    }
}
