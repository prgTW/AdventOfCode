<?php

namespace prgTW\AdventOfCode2020\Day5;

$input = file_get_contents('day5.txt');

/** @var array<array{row: string, seat: string}> $parsed */
$parsed = array_map(
	static function (string $line): array {
		preg_match('/^(?P<row>[FB]{7})(?P<seat>[LR]{3})/', $line, $matches);

		return ['row' => $matches['row'], 'seat' => $matches['seat']];
	},
	array_filter(explode("\n", $input))
);

$seatIds = array_map(
	static function (array $data): int {
		$rowNo  = bindec(strtr($data['row'], ['F' => 0, 'B' => 1]));
		$seatNo = bindec(strtr($data['seat'], ['L' => 0, 'R' => 1]));

		return $rowNo * 8 + $seatNo;
	},
	$parsed
);

$highestSeatId = max($seatIds);

echo $highestSeatId, "\n";

// --- Part Two ---

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

echo $mySeatId, "\n";
