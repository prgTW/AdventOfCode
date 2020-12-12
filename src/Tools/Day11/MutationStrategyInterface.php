<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl\Tools\Day11;

interface MutationStrategyInterface
{
	/**
	 * @param int                  $x
	 * @param int                  $y
	 * @param array<array<string>> $cells
	 *
	 * @return string
	 */
	public function mutate(int $x, int $y, array $cells): string;
}
