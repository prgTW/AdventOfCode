<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Year2020;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day13 extends AbstractDayChallenge
{
    private int $timestampOffset;
    /** @var array<int, int> */
    private array $schedules;

    public function __construct(string $inputFilePath)
    {
        parent::__construct($inputFilePath);
        [$timestampOffset, $schedules] = explode("\n", $this->input);
        $this->timestampOffset = (int)$timestampOffset;
        $this->schedules       = explode(',', $schedules);
    }

    public function part1(): int
    {
        $relevantSchedules = array_filter($this->schedules, static fn(string $busId) => 'x' !== $busId);
        $relevantSchedules = array_map(static fn(string $schedule) => (int)$schedule, $relevantSchedules);
        $relevantSchedules = array_combine($relevantSchedules, $relevantSchedules);

        $offsets = array_map(
            function (int $schedule): int {
                return (int)ceil($this->timestampOffset / $schedule) * $schedule;
            },
            $relevantSchedules
        );

        asort($offsets);
        $minutesToWait = reset($offsets) - $this->timestampOffset;

        return $minutesToWait * array_key_first($offsets);
    }

    /**
     * @link https://en.wikipedia.org/wiki/Chinese_remainder_theorem
     *
     * @return int
     */
    public function part2(): int
    {
        $relevantSchedules = array_filter(array_values($this->schedules), static fn(string $busId) => 'x' !== $busId);
        $relevantSchedules = array_map(static fn(string $schedule) => (int)$schedule, $relevantSchedules);

        $count = count($relevantSchedules);

        $quotients  = [];
        $remainders = [];
        foreach ($relevantSchedules as $remainder => $quotient) {
            $quotients[]  = $quotient;
            $remainders[] = ($quotient - $remainder) % $quotient;
        }

        $chunks = [];
        $N      = array_product($quotients);
        for ($i = 0; $i < $count; ++$i) {
            [$qi, $ri] = array_column([$quotients, $remainders], $i);
            $p        = intdiv($N, $qi);
            $chunks[] = [$ri, $this->mulInv($p, $qi), $p]; // cannot use gmp_gcdext :(
        }

        return array_sum(array_map('array_product', $chunks)) % $N;
    }

    /**
     * Finds x where (a * x) % b === 1
     *
     * @link https://en.wikipedia.org/wiki/Extended_Euclidean_algorithm
     *
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    private function mulInv(int $a, int $b): int
    {
        $b0 = $b;
        [$x0, $x1] = [0, 1];

        if (1 === $b) {
            return 1;
        }
        while ($a > 1) {
            $q = intdiv($a, $b);

            [$a, $b] = [$b, $a % $b];
            [$x0, $x1] = [$x1 - $q * $x0, $x0];
        }
        if ($x1 < 0) {
            $x1 += $b0;
        }

        return $x1;
    }
}
