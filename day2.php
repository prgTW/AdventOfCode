<?php

namespace prgTW\AdventOfCode2020\Day2;

$input = file_get_contents('day2.txt');

preg_match_all(
	'/^(?P<min>\d+)\\-(?P<max>\d+)\s(?P<char>.): (?P<pass>.+?)$/im',
	$input,
	$allPasswords,
	PREG_SET_ORDER
);
/** @var array<array{min: int, max: int, char: string, pass: string}> $allPasswords */

$passwordsValidPart1 = array_filter(
	$allPasswords,
	static function ($line): bool {
		['min' => $min, 'max' => $max, 'char' => $char, 'pass' => $password] = $line;
		$noOccurences = substr_count($password, $char);

		return $noOccurences >= $min && $noOccurences <= $max;
	}
);

echo count($passwordsValidPart1), "\n";

$passwordsValidPart2 = array_filter(
	$allPasswords,
	static function ($line): bool {
		['min' => $pos1, 'max' => $pos2, 'char' => $char, 'pass' => $password] = $line;

		return $char === $password[$pos1 - 1] xor $char === $password[$pos2 - 1];
	}
);

echo count($passwordsValidPart2), "\n";
