<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode2020\Impl\Contracts\HasPart1Challenge;
use prgTW\AdventOfCode2020\Impl\Contracts\HasPart2Challenge;

class Day5 extends AbstractDayChallenge implements HasPart1Challenge, HasPart2Challenge
{
	/** @var array<array{row: string, seat: string}> */
	private array $parsed;

	public function __construct(string $input)
	{
		parent::__construct($input);
		$this->parsed = array_map(
			static function (string $line): array {
				preg_match('/^(?P<row>[FB]{7})(?P<seat>[LR]{3})/', $line, $matches);

				return ['row' => $matches['row'], 'seat' => $matches['seat']];
			},
			array_filter(explode("\n", $this->input))
		);
	}

	public function part1()
	{
		return max($this->getSeatIds());
	}

	public function part2()
	{
		$seatIds = $this->getSeatIds();

		natsort($seatIds);
		$seatIds = array_values($seatIds); // reindex the array

		$mySeatId = null;
		for ($i = 1, $noSeats = count($seatIds); $i <= $noSeats - 2; ++$i) {
			$currSeatId = $seatIds[$i];
			$nextSeatId = $seatIds[$i + 1];
			if ($nextSeatId === $currSeatId + 2 && $nextSeatId - 2 === $currSeatId) {
				$mySeatId = $currSeatId + 1; // (($currSeatId + $nextSeatId) / 2)
				break;
			}
		}

		return $mySeatId;
	}

	/**
	 * @return int[]
	 */
	private function getSeatIds(): array
	{
		return array_map(
			static function (array $data): int {
				$rowNo  = bindec(strtr($data['row'], ['F' => 0, 'B' => 1]));
				$seatNo = bindec(strtr($data['seat'], ['L' => 0, 'R' => 1]));

				return $rowNo * 8 + $seatNo;
			},
			$this->parsed
		);
	}
}
