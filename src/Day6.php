<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;

class Day6 extends AbstractDayChallenge
{
	/** @var array<int, array<int, string>> */
	private array $parsedInput;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);
		$this->parsedInput = array_map(
			static fn(string $line): array => array_values(array_filter(explode("\n", $line))),
			array_filter(explode("\n\n", $this->input))
		);
	}


	public function part1(): int
	{
		return array_sum(
			array_map(
				static fn(array $answersPerPerson): int => count(
					array_unique(str_split(implode('', $answersPerPerson)))
				),
				$this->parsedInput
			)
		);
	}

	public function part2(): int
	{
		$uniqueAnswersPerGroup = array_map(
			static function (array $answersPerPerson): int {
				$uniqueAnswersPerPerson = array_map(
					static fn(string $personAnswers): array => array_unique(str_split($personAnswers)),
					$answersPerPerson
				);

				if (1 === count($answersPerPerson)) {
					return count(reset($uniqueAnswersPerPerson));
				}

				return count(array_intersect(...$uniqueAnswersPerPerson));
			},
			$this->parsedInput
		);

		return array_sum($uniqueAnswersPerGroup);
	}
}
