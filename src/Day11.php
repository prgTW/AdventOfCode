<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\GameOfLife;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\GameOfLifeFactory;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\Seat;

class Day11 extends AbstractDayChallenge
{
	/** @var array<array<string>> */
	private array $cells;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);
		$this->cells = array_map(static fn(string $line): array => str_split($line), explode("\n", $this->input));
	}

	public function part1(): int
	{
		$generation     = GameOfLifeFactory::createPart1Rules($this->cells);
		$lastGeneration = $this->runGameOfLife($generation);

		return iterator_count($lastGeneration->getCellsOfType(Seat::OCCUPIED));
	}

	public function part2(): int
	{
		$generation     = GameOfLifeFactory::createPart2Rules($this->cells);
		$lastGeneration = $this->runGameOfLife($generation);

		return iterator_count($lastGeneration->getCellsOfType(Seat::OCCUPIED));
	}

	private function runGameOfLife(GameOfLife $generation): GameOfLife
	{
		do {
			$nextGeneration = $generation->nextGeneration();
			if ($nextGeneration->equals($generation)) {
				break;
			}
			$generation = $nextGeneration;
		} while (true);

		return $generation;
	}
}
