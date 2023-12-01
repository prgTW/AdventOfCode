<?php

namespace prgTW\AdventOfCode\Impl\Year2020;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day5 extends AbstractDayChallenge
{
    /** @var array<array{row: string, seat: string}> */
    private array $parsed;

    public function __construct(string $inputFilePath)
    {
        parent::__construct($inputFilePath);
        $this->parsed = array_map(
            static function (string $line): array {
                preg_match('/^(?P<row>[FB]{7})(?P<seat>[LR]{3})/', $line, $matches);

                return ['row' => $matches['row'], 'seat' => $matches['seat']];
            },
            array_filter(explode("\n", $this->input))
        );
    }

    public function part1(): int
    {
        return max($this->getSeatIds());
    }

    public function part2(): ?int
    {
        $seatIds = $this->getSeatIds();

        natsort($seatIds);
        $seatIds = array_values($seatIds); // reindex the array

        for ($i = 1, $noSeats = count($seatIds); $i <= $noSeats - 2; ++$i) {
            $currSeatId = $seatIds[$i];
            $nextSeatId = $seatIds[$i + 1];
            if ($nextSeatId === $currSeatId + 2 && $nextSeatId - 2 === $currSeatId) {
                return $currSeatId + 1; // (($currSeatId + $nextSeatId) / 2)
            }
        }

        return null; // no seat missing
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
