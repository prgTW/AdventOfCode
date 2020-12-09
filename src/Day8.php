<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode2020\Impl\Exception\InfiniteLoopException;

class Day8 extends AbstractDayChallenge
{
	/** @var array<array{op: string, arg: int}> */
	private array $instructions;
	private int $noInstructions;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);

		$this->instructions   = array_map(
			static function (string $line): array {
				preg_match('/^(?P<op>\\w+) (?P<arg>[+-]\d+)$/', $line, $matches);

				return [
					'op'  => $matches['op'],
					'arg' => (int)$matches['arg'],
				];
			},
			explode("\n", $this->input)
		);
		$this->noInstructions = count($this->instructions);
	}

	public function part1()
	{
		try {
			$this->runProgram($this->instructions);
		} catch (InfiniteLoopException $infiniteLoopException) {
			return $infiniteLoopException->getLastAccumulatorValue();
		}
	}

	public function part2()
	{
		$possiblyCorruptedInstructionPointers = array_keys(
			array_filter(
				$this->instructions,
				static fn(array $instruction) => in_array($instruction['op'], ['jmp', 'nop'], true)
			)
		);

		do {
			foreach ($possiblyCorruptedInstructionPointers as $instructionPointer) {
				$newInstructions                            = $this->instructions;
				$newInstructions[$instructionPointer]['op'] = strtr(
					$newInstructions[$instructionPointer]['op'],
					[
						'jmp' => 'nop',
						'nop' => 'jmp',
					]
				);

				try {
					return $this->runProgram($newInstructions);
				} catch (InfiniteLoopException $infiniteLoopException) {
					// continue with next iteration
				}
			}
		} while (true);
	}

	/**
	 * @param array<array{op: string, arg: int}> $instructions
	 * @param int $opsLimit
	 *
	 * @return int Value of the accumulator
	 * @throws InfiniteLoopException
	 */
	private function runProgram(
		array $instructions,
		int $opsLimit = 10 ** 6
	): int {
		$accumulator        = 0;
		$instructionPointer = 0;

		$preventSameInstructionExecutedTwice = static function (int $instructionPointer, int $accumulator): void {
			static $instructionsVisited = [];

			if (isset($instructionsVisited[$instructionPointer])) {
				throw InfiniteLoopException::forLastAccumulatorValue($accumulator);
			}
			$instructionsVisited[$instructionPointer] = true;
		};


		while ($instructionPointer < $this->noInstructions) {
			['op' => $op, 'arg' => $arg] = $instructions[$instructionPointer];
			switch ($op) {
				case 'acc':
					$preventSameInstructionExecutedTwice($instructionPointer, $accumulator);
					$accumulator += $arg;
					++$instructionPointer;
					break;
				case 'jmp':
					$instructionPointer += $arg;
					break;
				case 'nop':
					$preventSameInstructionExecutedTwice($instructionPointer, $accumulator);
					++$instructionPointer;
					break;
			}

			// Infinite loop prevention
			if (--$opsLimit <= 0) {
				throw InfiniteLoopException::forLastAccumulatorValue($accumulator);
			}
		}

		return $accumulator;
	}
}
