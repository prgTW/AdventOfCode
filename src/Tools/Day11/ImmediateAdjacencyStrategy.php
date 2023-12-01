<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Tools\Day11;

class ImmediateAdjacencyStrategy extends FirstVisibleAdjacencyStrategy
{
    public function __construct()
    {
        parent::__construct(1);
    }
}
