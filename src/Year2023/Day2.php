<?php

namespace prgTW\AdventOfCode\Impl\Year2023;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day2 extends AbstractDayChallenge
{
    public function part1(): int
    {
        $limits = ['red' => 12, 'green' => 13, 'blue' => 14];

        $possibleGames = [];
        foreach ($this->lines() as $line) {
            [$game, $sets] = explode(': ', $line, 2);
            $game = preg_replace('/\D+/', '', $game);
            $sets = explode(';', $sets);
            foreach ($sets as $set) {
                $colors = explode(',', $set);
                foreach ($colors as $colorAndCount) {
                    [$count, $color] = explode(' ', trim($colorAndCount), 2);
                    if ((int)$count > $limits[$color]) {
                        continue 3;
                    }
                }
            }
            $possibleGames[] = (int)$game;
        }

        return array_sum($possibleGames);
    }

    public function part2(): int
    {
        $allMinimums = [];

        foreach ($this->lines() as $line) {
            $minimums = [];
            [, $sets] = explode(': ', $line, 2);
            $sets = explode(';', $sets);
            foreach ($sets as $set) {
                $colors = explode(',', $set);
                foreach ($colors as $colorAndCount) {
                    [$count, $color] = explode(' ', trim($colorAndCount), 2);
                    if ($count > ($minimums[$color] ?? PHP_INT_MIN)) {
                        $minimums[$color] = (int)$count;
                    }
                }
            }
            $allMinimums[] = $minimums;
        }

        return array_sum(array_map('array_product', $allMinimums));

    }
}
