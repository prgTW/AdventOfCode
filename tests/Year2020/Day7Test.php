<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day7;

class Day7Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day7(__DIR__.'/../fixtures/2020/day7/day7_1.txt');
        self::assertSame(4, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day7(__DIR__.'/../../input/2020/day7.txt');
        self::assertSame(235, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day7(__DIR__.'/../fixtures/2020/day7/day7_2.txt');
        self::assertSame(126, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day7(__DIR__.'/../../input/2020/day7.txt');
        self::assertSame(158493, $challenge->part2());
    }
}
