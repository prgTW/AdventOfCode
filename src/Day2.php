<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode2020\Impl\Contracts\HasPart1Challenge;
use prgTW\AdventOfCode2020\Impl\Contracts\HasPart2Challenge;

class Day2 extends AbstractDayChallenge implements HasPart1Challenge, HasPart2Challenge
{
	/** @var array<array{min: int, max: int, char: string, pass: string}> */
	private array $passwords;

	public function __construct(string $input)
	{
		parent::__construct($input);
		preg_match_all(
			'/^(?P<min>\d+)\\-(?P<max>\d+)\s(?P<char>.): (?P<pass>.+?)$/im',
			$this->input,
			$passwords,
			PREG_SET_ORDER
		);
		$this->passwords = $passwords;
	}

	public function part1()
	{
		$passwordsValidPart1 = array_filter(
			$this->passwords,
			static function ($line): bool {
				['min' => $min, 'max' => $max, 'char' => $char, 'pass' => $password] = $line;
				$noOccurences = substr_count($password, $char);

				return $noOccurences >= $min && $noOccurences <= $max;
			}
		);

		return count($passwordsValidPart1);
	}

	public function part2()
	{
		$passwordsValidPart2 = array_filter(
			$this->passwords,
			static function ($line): bool {
				['min' => $pos1, 'max' => $pos2, 'char' => $char, 'pass' => $password] = $line;

				return $char === $password[$pos1 - 1] xor $char === $password[$pos2 - 1];
			}
		);

		return count($passwordsValidPart2);
	}
}
