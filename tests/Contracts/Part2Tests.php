<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests\Contracts;

use prgTW\AdventOfCode2020\Impl\Contracts\HasPart2Challenge;

trait Part2Tests
{
	/** @dataProvider getPart2TestInputs */
	public function testPart2TestInput(string $input, $expectedOutput): void
	{
		$className = $this->getTestClass();

		/** @var HasPart2Challenge $class */
		$class = new $className($input);
		self::assertInstanceOf(HasPart2Challenge::class, $class);
		self::assertSame($expectedOutput, $class->part2());
	}
}
