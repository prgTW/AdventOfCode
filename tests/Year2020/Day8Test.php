<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day8;

class Day8Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day8(__DIR__.'/../fixtures/2020/day8/day8_1.txt');
        self::assertSame(5, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day8(__DIR__.'/../../input/2020/day8.txt');
        self::assertSame(1553, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day8(__DIR__.'/../fixtures/2020/day8/day8_1.txt');
        self::assertSame(8, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day8(__DIR__.'/../../input/2020/day8.txt');
        self::assertSame(1877, $challenge->part2());
    }
}
