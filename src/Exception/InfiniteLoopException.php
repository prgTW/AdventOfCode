<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl\Exception;

use Exception;

class InfiniteLoopException extends Exception
{
	private int $lastAccumulatorValue;

	public static function forLastAccumulatorValue(int $accumulator): self
	{
		$e                       = new self;
		$e->lastAccumulatorValue = $accumulator;

		return $e;
	}

	public function getLastAccumulatorValue(): int
	{
		return $this->lastAccumulatorValue;
	}
}
