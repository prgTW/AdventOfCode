<?php

namespace prgTW\AdventOfCode\Impl\Year2023;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day4 extends AbstractDayChallenge
{
    public function part1(): int
    {
        $sum = 0;
        foreach ($this->lines() as $line) {
            preg_match('/:(?P<winning>.+)\|(?P<mine>.+)$/', $line, $matches);
            $winning  = array_map('intval', str_split($matches['winning'], 3));
            $mine     = array_map('intval', str_split($matches['mine'], 3));
            $matching = count(array_intersect($winning, $mine));
            if ($matching > 0) {
                $sum += pow(2, $matching - 1);
            }
        }

        return $sum;
    }

    public function part2(): int
    {
        $repeat = [];
        foreach ($this->lines() as $line) {
            preg_match('/^Card\s+(?P<card>\d+):(?P<winning>.+)\|(?P<mine>.+)$/', $line, $matches);
            $card     = (int)$matches['card'];
            $winning  = array_map('intval', str_split($matches['winning'], 3));
            $mine     = array_map('intval', str_split($matches['mine'], 3));
            $matching = count(array_intersect($winning, $mine));

            $repeat[$card] ??= 1;
            if ($matching > 0) {
                for ($times = 1; $times <= $repeat[$card] ?? 1; ++$times) {
                    for ($cardDiff = 1; $cardDiff <= $matching; ++$cardDiff) {
                        $repeat[$card + $cardDiff] ??= 1;
                        $repeat[$card + $cardDiff] += 1;
                    }
                }
            }
        }

        return array_sum($repeat);
    }
}
