<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Year2020;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Year2020\Day14;

class Day14Test extends TestCase
{
    public function testPart1TestInput(): void
    {
        $class = new Day14(__DIR__.'/../fixtures/2020/day14/day14_1.txt');
        self::assertSame(165, $class->part1());
    }

    /**
     * @depends testPart1TestInput
     */
    public function testPart1RealInput(): void
    {
        $class = new Day14(__DIR__.'/../../input/2020/day14.txt');
        self::assertSame(17028179706934, $class->part1());
    }

    public function testPart2TestInput(): void
    {
        $class = new Day14(__DIR__.'/../fixtures/2020/day14/day14_2.txt');
        self::assertSame(208, $class->part2());
    }

    /**
     * @depends testPart2TestInput
     */
    public function testPart2RealInput(): void
    {
        $class = new Day14(__DIR__.'/../../input/2020/day14.txt');
        self::assertSame(3683236147222, $class->part2());
    }
}
