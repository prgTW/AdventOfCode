<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl\Tools\Day11;

class GameOfLifeFactory
{
	/**
	 * @param array<array<string>> $cells
	 *
	 * @return GameOfLife
	 */
	public static function createPart1Rules(array $cells): GameOfLife
	{
		return new GameOfLife(
			$cells,
			new MutationStrategy(new ImmediateAdjacencyStrategy, new ImmediateAdjacencyStrategy, 4)
		);
	}

	/**
	 * @param array<array<string>> $cells
	 *
	 * @return GameOfLife
	 */
	public static function createPart2Rules(array $cells): GameOfLife
	{
		return new GameOfLife(
			$cells,
			new MutationStrategy(new FirstVisibleAdjacencyStrategy, new FirstVisibleAdjacencyStrategy, 5)
		);
	}
}
