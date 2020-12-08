<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use prgTW\AdventOfCode2020\Impl\Day7;
use prgTW\AdventOfCode2020\Tests\Contracts\AbstractDayTestCase;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart2Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part2Tests;

class Day7Test extends AbstractDayTestCase implements HasPart1Tests, HasPart2Tests
{
	use Part1Tests;
	use Part2Tests;

	protected function getTestClass(): string
	{
		return Day7::class;
	}

	public function getPart1TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day7/day7_1.txt'),
			4,
		];
	}

	public function getPart2TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day7/day7_2.txt'),
			126,
		];
	}
}
