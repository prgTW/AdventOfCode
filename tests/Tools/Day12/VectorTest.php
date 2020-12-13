<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests\Tools\Day12;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode2020\Impl\Tools\Day12\Vector;

class VectorTest extends TestCase
{
	public function testGetX(): void
	{
		$vector = new Vector(1, 2);
		self::assertSame(1.0, $vector->getX());
	}

	public function testGetY(): void
	{
		$vector = new Vector(1, 2);
		self::assertSame(2.0, $vector->getY());
	}

	public function testTranslate(): void
	{
		$vector = new Vector(1, 2);
		$vector = $vector->translate(new Vector(3, -3));

		self::assertSame(4.0, $vector->getX());
		self::assertSame(-1.0, $vector->getY());
	}

	public function testScale(): void
	{
		$vector = new Vector(-5, 10);
		$vector = $vector->scale(3);

		self::assertSame(-15.0, $vector->getX());
		self::assertSame(30.0, $vector->getY());
	}


	/**
	 * @dataProvider provideRotations
	 */
	public function testRotateVector(Vector $vector, int $angle, bool $clockwise, Vector $expectedVector): void
	{
		$newVector = $vector->rotate($angle, $clockwise);

		self::assertEquals($expectedVector, $newVector);
	}

	public function provideRotations(): iterable
	{
		return [
			[new Vector(0, 0), 0, true, new Vector(0, 0)],
			[new Vector(0, 0), 90, true, new Vector(0, 0)],
			[new Vector(0, 0), 180, true, new Vector(0, 0)],
			[new Vector(0, 0), 270, true, new Vector(0, 0)],
			[new Vector(0, 0), 360, true, new Vector(0, 0)],

			[new Vector(10, -1), 90, true, new Vector(1, 10)],
			[new Vector(10, -1), 180, true, new Vector(-10, 1)],
			[new Vector(10, -1), 270, true, new Vector(-1, -10)],
			[new Vector(10, -1), 360, true, new Vector(10, -1)],
		];
	}
}
