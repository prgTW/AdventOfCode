<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day3;

class Day3Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$challenge = new Day3(__DIR__.'/fixtures/day3/day3_1.txt');
		self::assertSame(7, $challenge->part1());
	}

	public function testPart1RealInput(): void
	{
		$challenge = new Day3(__DIR__.'/../input/day3.txt');
		self::assertSame(214, $challenge->part1());
	}

	public function testPart2TestInput(): void
	{
		$challenge = new Day3(__DIR__.'/fixtures/day3/day3_1.txt');
		self::assertSame(336, $challenge->part2());
	}

	public function testPart2RealInput(): void
	{
		$challenge = new Day3(__DIR__.'/../input/day3.txt');
		self::assertSame(8336352024, $challenge->part2());
	}
}
