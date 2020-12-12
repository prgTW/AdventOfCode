<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day1;

class Day1Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$challenge = new Day1(__DIR__.'/fixtures/day1/day1_1.txt');
		self::assertSame(514579, $challenge->part1());
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$challenge = new Day1(__DIR__.'/../input/day1.txt');
		self::assertSame(357504, $challenge->part1());
	}

	public function testPart2TestInput(): void
	{
		$challenge = new Day1(__DIR__.'/fixtures/day1/day1_1.txt');
		self::assertSame(241861950, $challenge->part2());
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$challenge = new Day1(__DIR__.'/../input/day1.txt');
		self::assertSame(12747392, $challenge->part2());
	}
}
