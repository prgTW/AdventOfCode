<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day11;

class Day11Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$class = new Day11(__DIR__.'/fixtures/day11/day11_part1_1.txt');
		self::assertSame(37, $class->part1());
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$class = new Day11(__DIR__.'/../input/day11.txt');
		self::assertSame(2324, $class->part1());
	}

	public function testPart2TestInput(): void
	{
		$class = new Day11(__DIR__.'/fixtures/day11/day11_part2_4.txt');
		self::assertSame(26, $class->part2());
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$class = new Day11(__DIR__.'/../input/day11.txt');
		self::assertSame(2068, $class->part2());
	}
}
