<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Tools\Day11;

use Generator;

interface AdjacencyStrategyInterface
{
    /**
     * @param int                  $x
     * @param int                  $y
     * @param array<array<string>> $cells
     * @param string               $cellType
     *
     * @return Generator|array<array{0: int, 1: int}>
     */
    public function getAdjacentSeats(int $x, int $y, array $cells, string $cellType): Generator;
}
