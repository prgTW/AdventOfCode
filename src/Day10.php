<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl;

use Generator;
use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode2020\Impl\Tools\Combinations;

class Day10 extends AbstractDayChallenge
{
	/** @var int[] */
	private array $joltages;
	private int $builtinJoltage;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);
		$this->joltages = array_map(static fn(string $line) => (int)$line, explode("\n", $this->input));
		sort($this->joltages, SORT_ASC); // THIS IS THE KEY TO EVERYTHING
		$this->builtinJoltage = max($this->joltages) + 3;
	}

	public function part1(): int
	{
		$chains = $this->generateValidChains([0], [...$this->joltages, $this->builtinJoltage]);
		foreach ($chains as $chain) {
			$diffs = [];

			$joltage = array_shift($chain);
			while ($nextJoltage = array_shift($chain)) {
				$diff         = $nextJoltage - $joltage;
				$diffs[$diff] = isset($diffs[$diff]) ? $diffs[$diff] + 1 : 1;
				$joltage      = $nextJoltage;
			}

			return ($diffs[1] ?? 0) * ($diffs[3] ?? 0);
		}
	}

	public function part2(): int
	{
		$joltagesChain = [0, ...$this->joltages];

		$noTotalCombinations = 1;
		while ([] !== $joltagesChain) {
			$rating            = array_shift($joltagesChain);
			$nearestJoltages   = array_filter(
				array_slice($joltagesChain, 0, 3, true),
				static function (int $joltage) use ($rating): bool {
					return $joltage - $rating > 0 && $joltage - $rating <= 3;
				}
			);
			$noNearestJoltages = count($nearestJoltages);

			if ($noNearestJoltages <= 1) { // 0 = no next, 1 = only 1 path, either way no need to multiply by 1
				continue;
			}

			array_splice($joltagesChain, 0, $noNearestJoltages);
			$nextRating = reset($joltagesChain);

			$noCombinations = 0;
			for ($k = 1; $k <= $noNearestJoltages; ++$k) {
				foreach (new Combinations($nearestJoltages, $k) as $possibleChain) {
					$validChains    = $this->generateValidChains([$rating], [...$possibleChain, $nextRating]);
					$noCombinations += iterator_count($validChains);
				}

			}
			$noTotalCombinations *= $noCombinations;
		}

		return $noTotalCombinations;
	}

	/**
	 * @param int[] $joltagesChain
	 * @param int[] $joltagesLeft
	 *
	 * @return Generator|array<array{joltage: int, diff: int}>
	 */
	private function generateValidChains(array $joltagesChain, array $joltagesLeft): Generator
	{
		if ([] === $joltagesLeft) {
			yield $joltagesChain;
		}

		$rating = $joltagesChain[array_key_last($joltagesChain)];

		$possibleJoltages = array_filter(
			array_slice($joltagesLeft, 0, 3, true),
			static function (int $joltage) use ($rating): bool {
				return $joltage - $rating > 0 && $joltage - $rating <= 3;
			}
		);
		unset($rating);

		foreach ($possibleJoltages as $idx => $joltage) {
			$newJoltagesChain = array_merge($joltagesChain, [$joltage]);
			$newJoltagesLeft  = $joltagesLeft;
			unset($newJoltagesLeft[$idx]);
			yield from $this->generateValidChains($newJoltagesChain, $newJoltagesLeft);
			unset($newJoltagesChain, $newJoltagesLeft);
		}
	}
}
