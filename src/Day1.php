<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;

class Day1 extends AbstractDayChallenge
{
	private array $numbers;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);
		$this->numbers = array_filter(explode("\n", $this->input));
	}

	public function part1(): int
	{
		$max = count($this->numbers);

		for ($i = 0; $i < $max; ++$i) {
			for ($j = $i + 1; $j < $max; ++$j) {
				if ($this->numbers[$i] + $this->numbers[$j] === 2020) {
					return $this->numbers[$i] * $this->numbers[$j];
				}
			}
		}
	}

	public function part2(): int
	{
		$max = count($this->numbers);

		for ($i = 0; $i < $max; ++$i) {
			for ($j = $i + 1; $j < $max; ++$j) {
				for ($k = $j + 1; $k < $max; ++$k) {
					if ($this->numbers[$i] + $this->numbers[$j] + $this->numbers[$k] === 2020) {
						return $this->numbers[$i] * $this->numbers[$j] * $this->numbers[$k];
					}
				}
			}
		}
	}
}
