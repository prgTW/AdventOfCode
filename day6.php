<?php

namespace prgTW\AdventOfCode2020\Day5;

$input = file_get_contents('day6.txt');

/** @var array<int, array<int, string>> $answers */
$answers = array_map(
	static fn(string $line): array => array_values(array_filter(explode("\n", $line))),
	array_filter(explode("\n\n", $input))
);

$sumOfCountsPart1 = array_sum(
	array_map(
		static fn(array $answersPerPerson): int => count(array_unique(str_split(implode('', $answersPerPerson), 1))),
		$answers
	)
);

echo $sumOfCountsPart1, "\n";

// --- Part Two ---

$uniqueAnswersPerGroup = array_map(
	static function (array $answersPerPerson): int {
		$uniqueAnswersPerPerson = array_map(
			static fn(string $personAnswers): array => array_unique(str_split($personAnswers, 1)),
			$answersPerPerson
		);

		if (1 === count($answersPerPerson)) {
			return count(reset($uniqueAnswersPerPerson));
		}

		return count(array_intersect(...$uniqueAnswersPerPerson));
	},
	$answers
);

$sumOfCountsPart2 = array_sum($uniqueAnswersPerGroup);

echo $sumOfCountsPart2, "\n";
