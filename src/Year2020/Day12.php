<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Year2020;

use InvalidArgumentException;
use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;
use prgTW\AdventOfCode\Impl\Tools\Day12\Vector;

class Day12 extends AbstractDayChallenge
{
    /** @var array<array{action: string, value: int}> */
    private $actions;

    public function __construct(string $inputFilePath)
    {
        parent::__construct($inputFilePath);
        $this->actions = array_map(
            static function (string $line) {
                preg_match('/^(?P<action>\w)(?P<value>\d+)$/', $line, $matches);

                return ['action' => $matches['action'], 'value' => (int)$matches['value']];
            },
            explode("\n", $this->input)
        );
    }

    public function part1(): int
    {
        $shipPosition = new Vector(0, 0);
        $shipCourse   = new Vector(1, 0);

        foreach ($this->actions as ['action' => $action, 'value' => $value]) {
            if (in_array($action, ['N', 'S', 'E', 'W'], true)) {
                $shipPosition = $this->performTranslation($shipPosition, $action, $value);
            }
            if (in_array($action, ['L', 'R'], true)) {
                $shipCourse = $this->performRotation($shipCourse, $action, $value);
            }
            if ('F' === $action) {
                $shipPosition = $this->performMovement($shipPosition, $shipCourse->scale($value));
            }
        }

        return (int)abs($shipPosition->getX()) + (int)abs($shipPosition->getY());
    }

    public function part2(): int
    {
        $shipPosition = new Vector(0, 0);
        $shipCourse   = new Vector(10, -1);

        foreach ($this->actions as ['action' => $action, 'value' => $value]) {
            if ($this->isTranslationAction($action)) {
                $shipCourse = $this->performTranslation($shipCourse, $action, $value);
            }
            if ($this->isRotationAction($action)) {
                $shipCourse = $this->performRotation($shipCourse, $action, $value);
            }
            if ($this->isMovementAction($action)) {
                $shipPosition = $this->performMovement($shipPosition, $shipCourse->scale($value));
            }
        }

        return (int)abs($shipPosition->getX()) + (int)abs($shipPosition->getY());
    }

    private function isTranslationAction(string $action): bool
    {
        return in_array($action, ['N', 'S', 'E', 'W'], true);
    }

    private function isRotationAction(string $action): bool
    {
        return in_array($action, ['L', 'R'], true);
    }

    private function isMovementAction(string $action): bool
    {
        return 'F' === $action;
    }

    private function performTranslation(Vector $vector, string $action, int $value): Vector
    {
        if ('N' === $action) {
            return $vector->translate(new Vector(0, -$value));
        }

        if ('S' === $action) {
            return $vector->translate(new Vector(0, $value));
        }

        if ('E' === $action) {
            return $vector->translate(new Vector($value, 0));
        }

        if ('W' === $action) {
            return $vector->translate(new Vector(-$value, 0));
        }

        throw new InvalidArgumentException;
    }

    private function performRotation(Vector $vector, string $action, int $value): Vector
    {
        if (!in_array($action, ['L', 'R'], true)) {
            throw new InvalidArgumentException;
        }

        return $vector->rotate($value, 'R' === $action);
    }

    private function performMovement(Vector $vector, Vector $byVector): Vector
    {
        return $vector->translate($byVector);
    }
}
