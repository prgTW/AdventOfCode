<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl\Contracts;

abstract class AbstractDayChallenge
{
	protected string $input;

	public function __construct(string $inputFilePath)
	{
		$this->input = rtrim(file_get_contents($inputFilePath), "\n");
	}
}
