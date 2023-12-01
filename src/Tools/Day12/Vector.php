<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Tools\Day12;

class Vector
{
    private float $x;
    private float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function translate(Vector $vector): Vector
    {
        return new Vector($this->x + $vector->x, $this->y + $vector->y);
    }

    public function scale(int $scale): Vector
    {
        return new Vector($this->x * $scale, $this->y * $scale);
    }

    /**
     * @param int  $degrees
     * @param bool $clockwise
     *
     * @return Vector
     */
    public function rotate(int $degrees, bool $clockwise): Vector
    {
        if ($clockwise) {
            $degrees = $degrees >= 0 ? $degrees : -$degrees; // ensure positive
        } else {
            $degrees = $degrees < 0 ? $degrees : -$degrees; // ensure negative
        }

        $radians = deg2rad($degrees);

        return new Vector(
            cos($radians) * $this->x - sin($radians) * $this->y,
            sin($radians) * $this->x + cos($radians) * $this->y,
        );
    }
}
