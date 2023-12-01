<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Tests\Tools\Year2020Day11;

use PHPUnit\Framework\TestCase;
use prgTW\AdventOfCode\Impl\Tools\Day11\GameOfLifeFactory;

class GameOfLifeTest extends TestCase
{
    /**
     * @dataProvider providePart1GenerationChain
     */
    public function testPart1Generations(string $currentGenerationPath, string $nextGenerationPath): void
    {
        $this->testMutation(
            [GameOfLifeFactory::class, 'createPart1Rules'],
            $currentGenerationPath,
            $nextGenerationPath
        );
    }

    public function providePart1GenerationChain(): iterable
    {
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part1_1.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part1_2.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part1_2.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part1_3.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part1_3.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part1_4.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part1_4.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part1_5.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part1_5.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part1_6.txt',
        ];
    }

    /**
     * @dataProvider providePart2GenerationChain
     */
    public function testPart2Generations(string $currentGenerationPath, string $nextGenerationPath): void
    {
        $this->testMutation(
            [GameOfLifeFactory::class, 'createPart2Rules'],
            $currentGenerationPath,
            $nextGenerationPath
        );
    }

    public function providePart2GenerationChain(): iterable
    {
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part2_4.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part2_5.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part2_5.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part2_6.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part2_6.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part2_7.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part2_7.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part2_8.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part2_8.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part2_9.txt',
        ];
        yield [
            __DIR__.'../../../fixtures/2020/day11/day11_part2_9.txt',
            __DIR__.'../../../fixtures/2020/day11/day11_part2_10.txt',
        ];
    }

    private function testMutation(
        callable $generationCreator,
        string $currentGenerationPath,
        string $nextGenerationPath
    ): void {
        $currentGenerationInput = $this->readFixture($currentGenerationPath);
        $currentGenerationCells = $this->createCells($currentGenerationInput);
        $currentGeneration      = $generationCreator($currentGenerationCells);

        self::assertSame(10, $currentGeneration->getWidth());
        self::assertSame(10, $currentGeneration->getHeight());
        self::assertSame($currentGenerationInput, $currentGeneration->toString());

        $nextGenerationInput = $this->readFixture($nextGenerationPath);
        $nextGeneration      = $currentGeneration->nextGeneration();

        self::assertSame(10, $nextGeneration->getWidth());
        self::assertSame(10, $nextGeneration->getHeight());
        self::assertSame($nextGenerationInput, $nextGeneration->toString());
    }

    private function readFixture(string $fixturePath): string
    {
        return rtrim(file_get_contents($fixturePath), "\n");
    }

    private function createCells(string $input): array
    {
        return array_map(static fn(string $line): array => str_split($line), explode("\n", $input));
    }
}
