<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use prgTW\AdventOfCode2020\Impl\Day8;
use prgTW\AdventOfCode2020\Tests\Contracts\AbstractDayTestCase;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart2Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part2Tests;

class Day8Test extends AbstractDayTestCase implements HasPart1Tests, HasPart2Tests
{
	use Part1Tests;
	use Part2Tests;

	protected function getTestClass(): string
	{
		return Day8::class;
	}

	public function getPart1TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day8/day8_1.txt'),
			5,
		];
		yield [
			file_get_contents(__DIR__.'/../input/day8.txt'),
			1553,
		];
	}

	public function getPart2TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day8/day8_1.txt'),
			8,
		];
		yield [
			file_get_contents(__DIR__.'/../input/day8.txt'),
			1877,
		];
	}
}
