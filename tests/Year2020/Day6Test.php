<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day6;

class Day6Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day6(__DIR__.'/../fixtures/2020/day6/day6_1.txt');
        self::assertSame(6, $challenge->part1());
    }

    public function testPart1TestInput2(): void
    {
        $challenge = new Day6(__DIR__.'/../fixtures/2020/day6/day6_2.txt');
        self::assertSame(11, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     * @depends testPart1TestInput2
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day6(__DIR__.'/../../input/2020/day6.txt');
        self::assertSame(6590, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day6(__DIR__.'/../fixtures/2020/day6/day6_2.txt');
        self::assertSame(6, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day6(__DIR__.'/../../input/2020/day6.txt');
        self::assertSame(3288, $challenge->part2());
    }
}
