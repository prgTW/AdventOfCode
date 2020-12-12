<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests\Tools\Day11;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\GameOfLife;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\FirstVisibleAdjacencyStrategy;
use prgTW\AdventOfCode2020\Impl\Tools\Day11\Seat;

class NearestAdjacencyStrategyTest extends TestCase
{
	/**
	 * @dataProvider provideGetAdjacentSeatsInputs
	 */
	public function testGetAdjacentSeats(
		string $fixturePath,
		int $x,
		int $y,
		string $cellType,
		int $expectedCount
	): void {
		$input = $this->readFixture($fixturePath);
		$cells = array_map(static fn(string $line): array => str_split($line), explode("\n", $input));

		$strategy      = new FirstVisibleAdjacencyStrategy;
		$adjacentSeats = $strategy->getAdjacentSeats($x, $y, $cells, $cellType);

		self::assertSame($expectedCount, iterator_count($adjacentSeats), 'Wrong number of seats found');
	}

	public function provideGetAdjacentSeatsInputs(): iterable
	{
		return [
			[__DIR__.'/../../fixtures/day11/day11_part2_1.txt', 3, 4, Seat::OCCUPIED, 8],
			[__DIR__.'/../../fixtures/day11/day11_part2_2.txt', 1, 1, Seat::EMPTY, 1],
			[__DIR__.'/../../fixtures/day11/day11_part2_3.txt', 3, 3, Seat::OCCUPIED, 0],
		];
	}

	private function readFixture(string $fixturePath): string
	{
		return rtrim(file_get_contents($fixturePath), "\n");
	}
}
