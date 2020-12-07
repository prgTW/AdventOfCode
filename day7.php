<?php

namespace prgTW\AdventOfCode2020\Day7;

$input = rtrim(file_get_contents('day7.txt'), "\n");

/** @var array<string> $rules */
$rules = array_map(
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
	explode("\n", $input)
);

$rules = array_column($rules, null, 'bagName');

function bagNamesThatContains(string $targetBagName, array $rules): \Generator
{
	foreach ($rules as ['bagName' => $bagName, 'nestedBags' => $nestedBags]) {
		if (in_array($targetBagName, array_column($nestedBags ?? [], 'bagName'), true)) {
			yield $bagName;
			foreach (bagNamesThatContains($bagName, $rules) as $_bagName) {
				yield $_bagName;
			}
		}
	}
}

$howManyContainsShinyGoldPart1 = count(array_unique(iterator_to_array(bagNamesThatContains('shiny gold', $rules))));

echo $howManyContainsShinyGoldPart1, "\n";

// --- Part Two ---

function howManyBagsInside(string $targetBagName, array $rules, int $quantity = 0): \Generator
{
	for ($i = $quantity; $i > 0; --$i) {
		yield $targetBagName;
	}
	foreach ($rules[$targetBagName]['nestedBags'] ?? [] as ['bagName' => $nestedBagName, 'quantity' => $nestedQuantity]) {
		for ($i = $nestedQuantity; $i > 0; --$i) {
			foreach (howManyBagsInside($nestedBagName, $rules, 1) as $_bagName) {
				yield $_bagName;
			}
		}
	}
}

$howManyContainsShinyGoldPart2 = iterator_count(howManyBagsInside('shiny gold', $rules));

echo $howManyContainsShinyGoldPart2, "\n";
