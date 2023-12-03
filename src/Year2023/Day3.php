<?php

namespace prgTW\AdventOfCode\Impl\Year2023;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day3 extends AbstractDayChallenge
{
    public function part1(): int
    {
        $symbols = [];
        $numbers = [];
        foreach ($this->lines() as $line) {
            preg_match_all('/(?P<symbol>[^\d.])/', $line, $symbolPositions, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            $positions = [];
            foreach ($symbolPositions as ['symbol' => [$symbol, $pos]]) {
                $positions[] = $pos;
            }
            $symbols[] = $positions;

            preg_match_all('/(?P<number>\d+)/', $line, $numberPositions, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            $positions = [];
            foreach ($numberPositions as ['number' => [$number, $pos]]) {
                $positions[] = [
                    'number' => (int)$number,
                    'left'   => (int)$pos,
                    'right'  => (int)$pos + strlen($number),
                ];
            }
            $numbers[] = $positions;
        }

        $sum = 0;
        foreach ($numbers as $line => $positions) {
            foreach ($positions as ['number' => $number, 'left' => $left, 'right' => $right]) {
                foreach ([-1, 0, 1] as $lineDiff) {
                    foreach ($symbols[$line + $lineDiff] ?? [] as $symbolPos) {
                        if ($symbolPos >= $left - 1 && $symbolPos <= $right) {
                            $sum += $number;
                            continue 3;
                        }
                    }
                }
            }
        }

        return $sum;
    }

    public function part2(): int
    {
        $symbols = [];
        $stars   = [];
        $numbers = [];
        foreach ($this->lines() as $line) {
            preg_match_all('/(?P<symbol>[^\d.])/', $line, $symbolPositions, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            $positions = [];
            foreach ($symbolPositions as ['symbol' => [$symbol, $pos]]) {
                $positions[] = $pos;
            }
            $symbols[] = $positions;

            preg_match_all('/(?P<star>\*)/', $line, $starPositions, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            $positions = [];
            foreach ($starPositions as ['star' => [$symbol, $pos]]) {
                $positions[] = $pos;
            }
            $stars[] = $positions;

            preg_match_all('/(?P<number>\d+)/', $line, $numberPositions, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            $positions = [];
            foreach ($numberPositions as ['number' => [$number, $pos]]) {
                $positions[] = [
                    'number' => (int)$number,
                    'left'   => (int)$pos,
                    'right'  => (int)$pos + strlen($number),
                ];
            }
            $numbers[] = $positions;
        }

        $sum = 0;
        foreach ($stars as $line => $positions) {
            foreach ($positions as $starPos) {
                $adjacentNumbers = [];
                foreach ([-1, 0, 1] as $lineDiff) {
                    foreach ($numbers[$line + $lineDiff] ?? [] as ['number' => $number, 'left' => $left, 'right' => $right]) {
                        if ($starPos >= $left - 1 && $starPos <= $right) {
                            $adjacentNumbers[] = $number;
                        }
                    }
                }
                if (2 === count($adjacentNumbers)) {
                    $sum += array_product($adjacentNumbers);
                }
            }
        }

        return $sum;
    }
}
