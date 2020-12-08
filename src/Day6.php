<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode2020\Impl\Contracts\HasPart1Challenge;
use prgTW\AdventOfCode2020\Impl\Contracts\HasPart2Challenge;

class Day6 extends AbstractDayChallenge implements HasPart1Challenge, HasPart2Challenge
{
	/** @var array<int, array<int, string>> */
	private array $parsedInput;

	public function __construct(string $input)
	{
		parent::__construct($input);
		$this->parsedInput = array_map(
			static fn(string $line): array => array_values(array_filter(explode("\n", $line))),
			array_filter(explode("\n\n", $this->input))
		);
	}


	public function part1()
	{
		return array_sum(
			array_map(
				static fn(array $answersPerPerson): int => count(
					array_unique(str_split(implode('', $answersPerPerson), 1))
				),
				$this->parsedInput
			)
		);
	}

	public function part2()
	{
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
			$this->parsedInput
		);

		return array_sum($uniqueAnswersPerGroup);
	}
}
