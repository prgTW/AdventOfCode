<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day9;

class Day9Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $class = new Day9(__DIR__.'/../fixtures/2020/day9/day9_1.txt', 5);
        self::assertSame(127, $class->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $class = new Day9(__DIR__.'/../../input/2020/day9.txt', 25);
        self::assertSame(69316178, $class->part1());
    }

    public function testPart2TestInput(): void
    {
        $class = new Day9(__DIR__.'/../fixtures/2020/day9/day9_1.txt', 5);
        self::assertSame(62, $class->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $class = new Day9(__DIR__.'/../../input/2020/day9.txt', 25);
        self::assertSame(9351526, $class->part2());
    }
}
