<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests\Contracts;

use prgTW\AdventOfCode2020\Impl\Contracts\HasPart1Challenge;

trait Part1Tests
{
	/** @dataProvider getPart1TestInputs */
	public function testPart1TestInput(string $input, $expectedOutput): void
	{
		$className = $this->getTestClass();

		/** @var HasPart1Challenge $class */
		$class = new $className($input);
		self::assertInstanceOf(HasPart1Challenge::class, $class);
		self::assertSame($expectedOutput, $class->part1());
	}
}
