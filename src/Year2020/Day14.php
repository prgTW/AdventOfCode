<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode\Impl\Year2020;

use prgTW\AdventOfCode\Impl\Contracts\AbstractDayChallenge;

class Day14 extends AbstractDayChallenge
{
    /** @var array<array{mask: string, writeOperations: array<array{address: int, value: int}>}> */
    private array $program;

    public function __construct(string $inputFilePath)
    {
        parent::__construct($inputFilePath);
        preg_match_all('/^mask = .{36}+(?:\nmem\[.+)*+$/m', $this->input, $matches, PREG_SET_ORDER);
        $this->program = array_map(
            static function (string $lines): array {
                [$maskLine, $writeOperationsLines] = explode("\n", $lines, 2);

                return [
                    'mask'            => substr($maskLine, 7),
                    'writeOperations' => array_map(
                        static function (string $line): array {
                            preg_match('/^mem\[(?P<address>\d+)\] = (?P<value>\d+)$/', $line, $matches);

                            return [
                                'address' => (int)$matches['address'],
                                'value'   => (int)$matches['value'],
                            ];
                        },
                        explode("\n", $writeOperationsLines)
                    ),
                ];
            },
            array_column($matches, 0)
        );
    }

    public function part1(): int
    {
        $memory = [];
        foreach ($this->program as ['mask' => $mask, 'writeOperations' => $writeOperations]) {
            $set0 = bindec(strtr($mask, ['X' => 0, '1' => 0, '0' => 1]));
            $set1 = bindec(strtr($mask, ['X' => 0]));

            foreach ($writeOperations as ['address' => $address, 'value' => $value]) {
                $memory[$address] = ($value | $set1) & ~$set0;
            }
        }

        return array_sum($memory);
    }

    public function part2(): int
    {
        $memory = [];
        foreach ($this->program as ['mask' => $mask, 'writeOperations' => $writeOperations]) {
            $set1         = bindec(strtr($mask, ['X' => 0]));
            $floatingBits = [];
            foreach (str_split($mask) as $idx => $bit) {
                if ('X' === $bit) {
                    $floatingBits[] = 35 - $idx;
                }
            }

            foreach ($writeOperations as ['address' => $address, 'value' => $value]) {
                $partialAddress = $address | $set1;
                for ($i = 2 ** count($floatingBits) - 1; $i >= 0; --$i) {
                    $floatingAddress = $partialAddress;
                    foreach ($floatingBits as $idx => $bitMask) {
                        if ((1 << $idx) & $i) {
                            $floatingAddress |= 1 << $bitMask;
                        } else {
                            $floatingAddress &= ~(1 << $bitMask);
                        }
                    }
                    $memory[$floatingAddress] = $value;
                }
            }
        }

        return array_sum($memory);
    }
}
