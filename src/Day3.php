<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;

class Day3 extends AbstractDayChallenge
{
	/** @var array<array<string>> */
	private array $map;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);
		$this->map = array_map(
			static function (string $line): array {
				return str_split($line);
			},
			array_filter(explode("\n", $this->input))
		);
	}

	public function part1()
	{
		return $this->countTrees(3, 1);
	}

	public function part2()
	{
		$treesCounts = array_map(
			function (array $data): int {
				[$xDiff, $yDiff] = $data;

				return $this->countTrees($xDiff, $yDiff);
			},
			[
				[1, 1],
				[3, 1],
				[5, 1],
				[7, 1],
				[1, 2],
			]
		);

		return array_product($treesCounts);
	}

	private function countTrees(int $xDiff, int $yDiff): int
	{
		$noRows     = count($this->map);
		$patternLen = count($this->map[0]);

		$x = $y = 0;

		$noTrees = 0;
		while ($y < $noRows) {
			if ('#' === $this->map[$y][$x]) {
				++$noTrees;
			}

			$x = ($x + $xDiff) % $patternLen;
			$y += $yDiff;
		}

		return $noTrees;
	}
}
