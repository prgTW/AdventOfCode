<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day4;

class Day4Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $challenge = new Day4(__DIR__.'/../fixtures/2020/day4/day4_1.txt');
        self::assertSame(2, $challenge->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $challenge = new Day4(__DIR__.'/../../input/2020/day4.txt');
        self::assertSame(213, $challenge->part1());
    }

    public function testPart2TestInput(): void
    {
        $challenge = new Day4(__DIR__.'/../fixtures/2020/day4/day4_2_invalid_passwords.txt');
        self::assertSame(0, $challenge->part2());
    }

    public function testPart2TestInput2(): void
    {
        $challenge = new Day4(__DIR__.'/../fixtures/2020/day4/day4_3_valid_passwords.txt');
        self::assertSame(4, $challenge->part2());
    }

    /**
     * @depends testPart2TestInput
     * @depends testPart2TestInput2
     */
    public function testPart2RealInput(): void
    {
        $challenge = new Day4(__DIR__.'/../../input/2020/day4.txt');
        self::assertSame(147, $challenge->part2());
    }
}
