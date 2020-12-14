<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day13;

class Day13Test extends TestCase
{
	public function testPart1TestInput(): void
	{
		$class = new Day13(__DIR__.'/fixtures/day13/day13_1.txt');
		self::assertSame(295, $class->part1());
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$class = new Day13(__DIR__.'/../input/day13.txt');
		self::assertSame(3789, $class->part1());
	}

	/**
	 * @dataProvider providePart2TestInputs
	 */
	public function testPart2TestInput(string $fixturePath, int $expectedResult): void
	{
		$class = new Day13($fixturePath);
		self::assertSame($expectedResult, $class->part2());
	}

	public function providePart2TestInputs(): iterable
	{
		return [
			[__DIR__.'/fixtures/day13/day13_1.txt', 1068781],
			[__DIR__.'/fixtures/day13/day13_2.txt', 3417],
			[__DIR__.'/fixtures/day13/day13_3.txt', 754018],
			[__DIR__.'/fixtures/day13/day13_4.txt', 779210],
			[__DIR__.'/fixtures/day13/day13_5.txt', 1261476],
			[__DIR__.'/fixtures/day13/day13_6.txt', 1202161486],
		];
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$class = new Day13(__DIR__.'/../input/day13.txt');
		self::assertSame(667437230788118, $class->part2());
	}
}
