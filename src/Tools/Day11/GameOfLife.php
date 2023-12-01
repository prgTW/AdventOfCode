<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Tools\Day11;

use Generator;

class GameOfLife
{
    private int $width;
    private int $height;
    /** @var array<array<string>> */
    private array $cells;
    private MutationStrategyInterface $mutationStrategy;

    public function __construct(array $cells, MutationStrategyInterface $mutationStrategy)
    {
        $this->width            = count(reset($cells));
        $this->height           = count($cells);
        $this->cells            = $cells;
        $this->mutationStrategy = $mutationStrategy;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getCells(): array
    {
        return $this->cells;
    }

    /**
     * @return Generator|array<array{0: int, 1: int}>
     */
    public function getCellsOfType(string $cellType): Generator
    {
        foreach ($this->cells as $y => $rows) {
            foreach ($rows as $x => $cell) {
                if ($this->cells[$y][$x] === $cellType) {
                    yield [$x, $y];
                }
            }
        }
    }

    public function nextGeneration(): self
    {
        $newCells = [];

        foreach ($this->cells as $y => $rows) {
            foreach ($rows as $x => $cell) {
                $newCells[$y][$x] = $this->mutationStrategy->mutate($x, $y, $this->cells);
            }
        }

        return new self($newCells, $this->mutationStrategy);
    }

    public function toString(): string
    {
        return implode("\n", array_map(static fn(array $row) => implode('', $row), $this->cells));
    }

    public function equals(GameOfLife $generation): bool
    {
        if ($this->width !== $generation->getWidth()) {
            return false;
        }

        if ($this->height !== $generation->getHeight()) {
            return false;
        }

        foreach ($this->cells as $y => $rows) {
            foreach ($rows as $x => $cell) {
                if ($this->cells[$y][$x] !== $generation->getCells()[$y][$x]) {
                    return false;
                }
            }
        }

        return true;
    }
}
