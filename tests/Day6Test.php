<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use prgTW\AdventOfCode2020\Impl\Day6;
use prgTW\AdventOfCode2020\Tests\Contracts\AbstractDayTestCase;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart2Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part2Tests;

class Day6Test extends AbstractDayTestCase implements HasPart1Tests, HasPart2Tests
{
	use Part1Tests;
	use Part2Tests;

	protected function getTestClass(): string
	{
		return Day6::class;
	}

	public function getPart1TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day6/day6_1.txt'),
			6,
		];
		yield [
			file_get_contents(__DIR__.'/fixtures/day6/day6_2.txt'),
			11,
		];
		yield [
			file_get_contents(__DIR__.'/../input/day6.txt'),
			6590,
		];
	}

	public function getPart2TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day6/day6_2.txt'),
			6,
		];
		yield [
			file_get_contents(__DIR__.'/../input/day6.txt'),
			3288,
		];
	}
}
