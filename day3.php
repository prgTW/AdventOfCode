<?php

namespace prgTW\AdventOfCode2020\Day3;

$input = file_get_contents('day3.txt');

$map = array_map(
	static function (string $line): array {
		return str_split($line);
	},
	array_filter(explode("\n", $input))
);

function countTrees(array $map, int $xDiff, int $yDiff): int
{
	$noRows     = count($map);
	$patternLen = count($map[0]);

	$x = $y = 0;

	$noTrees = 0;
	while ($y < $noRows) {
		if ('#' === $map[$y][$x]) {
			++$noTrees;
		}

		$x = ($x + $xDiff) % $patternLen;
		$y += $yDiff;
	}

	return $noTrees;
}

echo countTrees($map, 3, 1), "\n";

$treesCounts = array_map(
	function (array $data) use ($map): int {
		[$xDiff, $yDiff] = $data;

		return countTrees($map, $xDiff, $yDiff);
	},
	[
		[1, 1],
		[3, 1],
		[5, 1],
		[7, 1],
		[1, 2],
	]
);

echo array_product($treesCounts), "\n";
