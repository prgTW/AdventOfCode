<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests;

use prgTW\AdventOfCode2020\Impl\Day4;
use prgTW\AdventOfCode2020\Tests\Contracts\AbstractDayTestCase;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\HasPart2Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part1Tests;
use prgTW\AdventOfCode2020\Tests\Contracts\Part2Tests;

class Day4Test extends AbstractDayTestCase implements HasPart1Tests, HasPart2Tests
{
	use Part1Tests;
	use Part2Tests;

	protected function getTestClass(): string
	{
		return Day4::class;
	}

	public function getPart1TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day4/day4_1.txt'),
			2,
		];
		yield [
			file_get_contents(__DIR__.'/../input/day4.txt'),
			213,
		];
	}

	public function getPart2TestInputs(): iterable
	{
		yield [
			file_get_contents(__DIR__.'/fixtures/day4/day4_2_invalid_passwords.txt'),
			0,
		];
		yield [
			file_get_contents(__DIR__.'/fixtures/day4/day4_3_valid_passwords.txt'),
			4,
		];
		yield [
			file_get_contents(__DIR__.'/../input/day4.txt'),
			147,
		];
	}
}
