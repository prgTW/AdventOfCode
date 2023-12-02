<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Contracts;

abstract class AbstractDayChallenge
{
    protected string $input;

    public function __construct(string $inputFilePath)
    {
        $this->input = rtrim(file_get_contents($inputFilePath), "\n");
    }

    /**
     * @return iterable<string>
     */
    protected function lines(): iterable
    {
        foreach (explode("\n", $this->input) as $line) {
            yield $line;
        }
    }
}
