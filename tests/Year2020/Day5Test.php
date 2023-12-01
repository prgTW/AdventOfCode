<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day5;

class Day5Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day5(__DIR__.'/../fixtures/2020/day5/day5_1.txt');
        self::assertSame(820, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day5(__DIR__.'/../../input/2020/day5.txt');
        self::assertSame(888, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day5(__DIR__.'/../fixtures/2020/day5/day5_1.txt');
        self::assertNull($challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day5(__DIR__.'/../../input/2020/day5.txt');
        self::assertSame(522, $challenge->part2());
    }
}
