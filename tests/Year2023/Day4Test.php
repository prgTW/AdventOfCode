<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2023;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2023\Day4;

class Day4Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day4(__DIR__.'/../fixtures/2023/day4/day4_1.txt');
        self::assertSame(13, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day4(__DIR__.'/../../input/2023/day4.txt');
        self::assertSame(18519, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day4(__DIR__.'/../fixtures/2023/day4/day4_1.txt');
        self::assertSame(30, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day4(__DIR__.'/../../input/2023/day4.txt');
        self::assertSame(11787590, $challenge->part2());
    }
}
