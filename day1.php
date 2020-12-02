<?php

namespace prgTW\AdventOfCode2020\Day1;

$input = file_get_contents('day1.txt');

$numbers = array_filter(explode("\n", $input));
$max     = count($numbers);

for ($i = 0; $i < $max; ++$i) {
	for ($j = $i + 1; $j < $max; ++$j) {
		if ($numbers[$i] + $numbers[$j] === 2020) {
			echo $numbers[$i] * $numbers[$j], "\n";
			break 2;
		}
	}
}

for ($i = 0; $i < $max; ++$i) {
	for ($j = $i + 1; $j < $max; ++$j) {
		for ($k = $j + 1; $k < $max; ++$k) {
			if ($numbers[$i] + $numbers[$j] + $numbers[$k] === 2020) {
				echo $numbers[$i] * $numbers[$j] * $numbers[$k], "\n";
				break 3;
			}
		}
	}
}
