<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2023;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2023\Day3;

class Day3Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day3(__DIR__.'/../fixtures/2023/day3/day3_1.txt');
        self::assertSame(4361, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day3(__DIR__.'/../../input/2023/day3.txt');
        self::assertSame(546312, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day3(__DIR__.'/../fixtures/2023/day3/day3_1.txt');
        self::assertSame(467835, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day3(__DIR__.'/../../input/2023/day3.txt');
        self::assertSame(87449461, $challenge->part2());
    }
}
