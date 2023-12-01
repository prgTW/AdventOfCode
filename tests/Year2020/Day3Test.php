<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day3;

class Day3Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day3(__DIR__.'/../fixtures/2020/day3/day3_1.txt');
        self::assertSame(7, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day3(__DIR__.'/../../input/2020/day3.txt');
        self::assertSame(214, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day3(__DIR__.'/../fixtures/2020/day3/day3_1.txt');
        self::assertSame(336, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day3(__DIR__.'/../../input/2020/day3.txt');
        self::assertSame(8336352024, $challenge->part2());
    }
}
