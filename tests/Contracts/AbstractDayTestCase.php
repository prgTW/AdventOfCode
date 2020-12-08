<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Tests\Contracts;

use PHPUnit\Framework\TestCase;

abstract class AbstractDayTestCase extends TestCase
{
	abstract protected function getTestClass(): string;
}
