<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Day15;

class Day15Test extends TestCase
{
	/**
	 * @dataProvider providePart1TestInputs
	 */
	public function testPart1TestInput(string $input, int $iteration, int $expectedOutput): void
	{
		$class = new Day15($input);
		self::assertSame($expectedOutput, $class->part1($iteration));
	}

	public function providePart1TestInputs(): iterable
	{
		return [
			['0,3,6', 2020, 436],
			['1,3,2', 2020, 1],
			['2,1,3', 2020, 10],
			['1,2,3', 2020, 27],
			['2,3,1', 2020, 78],
			['3,2,1', 2020, 438],
			['3,1,2', 2020, 1836],
		];
	}

	/**
	 * @depends testPart1TestInput
	 */
	public function testPart1RealInput(): void
	{
		$class = new Day15('5,1,9,18,13,8,0');
		self::assertSame(376, $class->part1(2020));
	}

	/**
	 * @dataProvider providePart2TestInputs
	 */
	public function testPart2TestInput(string $input, int $iteration, int $expectedOutput): void
	{
		$class = new Day15($input);
		self::assertSame($expectedOutput, $class->part1($iteration));
	}

	public function providePart2TestInputs(): iterable
	{
		return [
			['0,3,6', 30000000, 175594],
			['1,3,2', 30000000, 2578],
			['2,1,3', 30000000, 3544142],
			['1,2,3', 30000000, 261214],
			['2,3,1', 30000000, 6895259],
			['3,2,1', 30000000, 18],
			['3,1,2', 30000000, 362],
		];
	}

	/**
	 * @depends testPart2TestInput
	 */
	public function testPart2RealInput(): void
	{
		$class = new Day15('5,1,9,18,13,8,0');
		self::assertSame(323780, $class->part1(30000000));
	}
}
