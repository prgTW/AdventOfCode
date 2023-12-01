<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Tools\Day11;

use Generator;

class FirstVisibleAdjacencyStrategy implements AdjacencyStrategyInterface
{
    /** @var array<array{0: int, 1: int}> */
    private const DIRECTIONS = [
        [-1, -1],
        [0, -1],
        [1, -1],
        [-1, 0],
        [1, 0],
        [-1, 1],
        [0, 1],
        [1, 1],
    ];

    private ?int $maxRange;

    public function __construct(?int $maxRange = null)
    {
        $this->maxRange = $maxRange;
    }

    public function getAdjacentSeats(int $x, int $y, array $cells, string $cellType): Generator
    {
        $height   = count($cells);
        $width    = count(reset($cells));
        $maxRange = $this->maxRange ?? max($width, $height);

        foreach (self::DIRECTIONS as [$xDiffInitial, $yDiffInitial]) {
            $multiplier = 1;
            do {
                $xDiff = $xDiffInitial * $multiplier;
                $yDiff = $yDiffInitial * $multiplier;

                $newX = $x + $xDiff;
                if ($newX < 0 || $newX > $width - 1) {
                    break;
                }

                $newY = $y + $yDiff;
                if ($newY < 0 || $newY > $height - 1) {
                    break;
                }

                if ($cells[$newY][$newX] === $cellType) {
                    yield [$newX, $newY];
                    break;
                }

                if ($cells[$newY][$newX] !== Seat::FLOOR) {
                    break;
                }

                ++$multiplier;
            } while ($multiplier <= $maxRange);
        }
    }
}
