<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2023;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2023\Day1;

class Day1Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day1(__DIR__.'/../fixtures/2023/day1/day1_1.txt');
        self::assertSame(142, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day1(__DIR__.'/../../input/2023/day1.txt');
        self::assertSame(54239, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day1(__DIR__.'/../fixtures/2023/day1/day1_2.txt');
        self::assertSame(281, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day1(__DIR__.'/../../input/2023/day1.txt');
        self::assertSame(55343, $challenge->part2());
    }
}
