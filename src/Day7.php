<?php

namespace prgTW\AdventOfCode2020\Impl;

use Generator;
use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;

class Day7 extends AbstractDayChallenge
{
	/** @var array{bagName: string, nestedBags: array{bagName: string, quantity: int}} */
	private array $rules;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);

		$rules       = array_map(
			static function (string $rule): array {
				preg_match('/^(?P<bagName>.+?) bags contain (?P<nestedBags>.+)\.$/', $rule, $matches);
				$bagName    = $matches['bagName'];
				$nestedBags = 'no other bags' === $matches['nestedBags'] ?
					[]
					:
					array_map(
						static function (string $def): array {
							preg_match(
								'/^(?P<quantity>\\d+) (?P<bagName>.+?) bags?$/',
								trim($def),
								$matches
							);

							return array_intersect_key($matches, ['quantity' => 1, 'bagName' => 1]);
						},
						explode(',', $matches['nestedBags'])
					);

				return compact('bagName', 'nestedBags');
			},
			explode("\n", $this->input)
		);
		$this->rules = array_column($rules, null, 'bagName');
	}

	public function part1()
	{
		return count(array_unique(iterator_to_array($this->bagNamesThatContains('shiny gold'))));
	}

	public function part2()
	{
		return iterator_count($this->howManyBagsInside('shiny gold'));
	}

	private function bagNamesThatContains(string $targetBagName): Generator
	{
		foreach ($this->rules as ['bagName' => $bagName, 'nestedBags' => $nestedBags]) {
			if (in_array($targetBagName, array_column($nestedBags ?? [], 'bagName'), true)) {
				yield $bagName;
				foreach ($this->bagNamesThatContains($bagName) as $_bagName) {
					yield $_bagName;
				}
			}
		}
	}

	private function howManyBagsInside(string $targetBagName, int $quantity = 0): Generator
	{
		for ($i = $quantity; $i > 0; --$i) {
			yield $targetBagName;
		}
		foreach ($this->rules[$targetBagName]['nestedBags'] ?? [] as ['bagName' => $nestedBagName, 'quantity' => $nestedQuantity]) {
			for ($i = $nestedQuantity; $i > 0; --$i) {
				foreach ($this->howManyBagsInside($nestedBagName, 1) as $_bagName) {
					yield $_bagName;
				}
			}
		}
	}
}
