<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day10;

class Day10Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$class = new Day10(__DIR__.'/fixtures/day10/day10_1.txt');
		self::assertSame(35, $class->part1());
	}

	public function testPart1TestInput2(): void
	{
		$class = new Day10(__DIR__.'/fixtures/day10/day10_2.txt');
		self::assertSame(220, $class->part1());
	}

	public function testPart1RealInput(): void
	{
		$class = new Day10(__DIR__.'/../input/day10.txt');
		self::assertSame(2046, $class->part1());
	}

	public function testPart2TestInput(): void
	{
		$class = new Day10(__DIR__.'/fixtures/day10/day10_1.txt');
		self::assertSame(8, $class->part2());
	}

	public function testPart2TestInput2(): void
	{
		$class = new Day10(__DIR__.'/fixtures/day10/day10_2.txt');
		self::assertSame(19208, $class->part2());
	}

	public function testPart2RealInput(): void
	{
		$class = new Day10(__DIR__.'/../input/day10.txt');
		self::assertSame(1157018619904, $class->part2());
	}
}
