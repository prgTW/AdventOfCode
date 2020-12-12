<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl;

use Generator;
use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;

class Day9 extends AbstractDayChallenge
{
	/** @var int[] */
	private array $numbers;
	private int $noNumbers;
	private int $preambleLen;

	public function __construct(string $inputFilePath, int $preambleLen)
	{
		parent::__construct($inputFilePath);
		$this->numbers     = array_map(static fn(string $line) => (int)$line, explode("\n", $this->input));
		$this->noNumbers   = count($this->numbers);
		$this->preambleLen = $preambleLen;
	}

	public function part1(): int
	{
		for ($idx = $this->preambleLen; $idx < $this->noNumbers; ++$idx) {
			$number = $this->numbers[$idx];
			foreach ($this->getMatchingPairs($number, $idx - $this->preambleLen, $idx - 1) as $_) {
				continue 2;
			}

			return $number;
		}
	}

	public function part2(): int
	{
		$invalidNumber = $this->part1();

		$newNumbers   = array_values(array_filter($this->numbers, static fn(int $number) => $number <= $invalidNumber));
		$noNewNumbers = count($newNumbers);

		for ($noNumbersToChoose = 2; $noNumbersToChoose <= $noNewNumbers; ++$noNumbersToChoose) {
			for ($idx = 0, $max = $noNewNumbers - $noNumbersToChoose; $idx <= $max; ++$idx) {
				$chosenNumbers = array_slice($newNumbers, $idx, $noNumbersToChoose);
				$sum           = array_sum($chosenNumbers);
				if ($invalidNumber === $sum) {
					return min($chosenNumbers) + max($chosenNumbers);
				}
			}
		}
	}

	/**
	 * @param int $number
	 * @param int $minIdx
	 * @param int $maxIdx
	 *
	 * @return Generator|array<array<{0: int, 1: int}>>
	 */
	private function getMatchingPairs(int $number, int $minIdx, int $maxIdx): Generator
	{
		for ($i = $minIdx; $i <= $maxIdx; ++$i) {
			for ($j = $i + 1; $j <= $maxIdx; ++$j) {
				if ($number === ($this->numbers[$i] + $this->numbers[$j])) {
					yield [$this->numbers[$i], $this->numbers[$j]];
				}
			}
		}
	}
}
