<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day2;

class Day2Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$challenge = new Day2(__DIR__.'/fixtures/day2/day2_1.txt');
		self::assertSame(2, $challenge->part1());
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$challenge = new Day2(__DIR__.'/../input/day2.txt');
		self::assertSame(550, $challenge->part1());
	}

	public function testPart2TestInput(): void
	{
		$challenge = new Day2(__DIR__.'/fixtures/day2/day2_1.txt');
		self::assertSame(1, $challenge->part2());
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$challenge = new Day2(__DIR__.'/../input/day2.txt');
		self::assertSame(634, $challenge->part2());
	}
}
