<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day12;

class Day12Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$class = new Day12(__DIR__.'/fixtures/day12/day12_1.txt');
		self::assertSame(25, $class->part1());
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$class = new Day12(__DIR__.'/../input/day12.txt');
		self::assertSame(1133, $class->part1());
	}

	public function testPart2TestInput(): void
	{
		$class = new Day12(__DIR__.'/fixtures/day12/day12_1.txt');
		self::assertSame(286, $class->part2());
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$class = new Day12(__DIR__.'/../input/day12.txt');
		self::assertSame(61053, $class->part2());
	}
}
