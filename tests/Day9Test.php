<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day9;

class Day9Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$class = new Day9(__DIR__.'/fixtures/day9/day9_1.txt', 5);
		self::assertSame(127, $class->part1());
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$class = new Day9(__DIR__.'/../input/day9.txt', 25);
		self::assertSame(69316178, $class->part1());
	}

	public function testPart2TestInput(): void
	{
		$class = new Day9(__DIR__.'/fixtures/day9/day9_1.txt', 5);
		self::assertSame(62, $class->part2());
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$class = new Day9(__DIR__.'/../input/day9.txt', 25);
		self::assertSame(9351526, $class->part2());
	}
}
