<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests\Tools\Day11;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\GameOfLife;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\ImmediateAdjacencyStrategy;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\Seat;

class ImmediateAdjacencyStrategyTest extends TestCase
{
	public function testGetAdjacentSeats(): void
	{
		$input = $this->readFixture(__DIR__.'/../../fixtures/day11/day11_part2_1.txt');
		$cells = array_map(static fn(string $line): array => str_split($line), explode("\n", $input));

		$strategy      = new ImmediateAdjacencyStrategy;
		$adjacentSeats = $strategy->getAdjacentSeats(3, 4, $cells, Seat::OCCUPIED);

		self::assertSame(2, iterator_count($adjacentSeats), 'Wrong number of occupied seats found');
	}

	private function readFixture(string $fixturePath): string
	{
		return rtrim(file_get_contents($fixturePath), "\n");
	}
}
