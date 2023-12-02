<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2023;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2023\Day2;

class Day2Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day2(__DIR__.'/../fixtures/2023/day2/day2_1.txt');
        self::assertSame(8, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day2(__DIR__.'/../../input/2023/day2.txt');
        self::assertSame(2149, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day2(__DIR__.'/../fixtures/2023/day2/day2_2.txt');
        self::assertSame(2286, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day2(__DIR__.'/../../input/2023/day2.txt');
        self::assertSame(71274, $challenge->part2());
    }
}
