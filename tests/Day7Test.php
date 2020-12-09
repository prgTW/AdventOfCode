<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day7;

class Day7Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$challenge = new Day7(__DIR__.'/fixtures/day7/day7_1.txt');
		self::assertSame(4, $challenge->part1());
	}

	public function testPart1RealInput(): void
	{
		$challenge = new Day7(__DIR__.'/../input/day7.txt');
		self::assertSame(235, $challenge->part1());
	}

	public function testPart2TestInput(): void
	{
		$challenge = new Day7(__DIR__.'/fixtures/day7/day7_2.txt');
		self::assertSame(126, $challenge->part2());
	}

	public function testPart2RealInput(): void
	{
		$challenge = new Day7(__DIR__.'/../input/day7.txt');
		self::assertSame(158493, $challenge->part2());
	}
}
