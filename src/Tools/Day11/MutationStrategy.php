<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Tools\Day11;

class MutationStrategy implements MutationStrategyInterface
{
    private AdjacencyStrategyInterface $strategyForEmptySeats;
    private AdjacencyStrategyInterface $strategyForOccupiedSeats;
    private int $minOccupiedSeatsToEmpty;

    public function __construct(
        AdjacencyStrategyInterface $strategyForEmptySeats,
        AdjacencyStrategyInterface $strategyForOccupiedSeats,
        int $minOccupiedSeatsToEmpty
    ) {
        $this->minOccupiedSeatsToEmpty  = $minOccupiedSeatsToEmpty;
        $this->strategyForEmptySeats    = $strategyForEmptySeats;
        $this->strategyForOccupiedSeats = $strategyForOccupiedSeats;
    }

    public function mutate(int $x, int $y, array $cells): string
    {
        $cell = $cells[$y][$x];

        if (Seat::FLOOR === $cell) {
            return Seat::FLOOR;
        }

        if (
            Seat::EMPTY === $cell
            && 0 === $this->countAdjacentForEmptySeat($x, $y, $cells)
        ) {
            return Seat::OCCUPIED;
        }

        if (
            Seat::OCCUPIED === $cell
            && $this->minOccupiedSeatsToEmpty <= $this->countAdjacentForOccupiedSeat($x, $y, $cells)
        ) {
            return Seat::EMPTY;
        }

        return $cell;
    }

    private function countAdjacentForEmptySeat(int $x, int $y, array $cells): int
    {
        $adjacentSeats = $this->strategyForEmptySeats->getAdjacentSeats($x, $y, $cells, Seat::OCCUPIED);

        return iterator_count($adjacentSeats);
    }

    private function countAdjacentForOccupiedSeat(int $x, int $y, array $cells): int
    {
        $adjacentSeats = $this->strategyForOccupiedSeats->getAdjacentSeats($x, $y, $cells, Seat::OCCUPIED);

        return iterator_count($adjacentSeats);
    }
}
