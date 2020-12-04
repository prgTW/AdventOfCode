<?php

namespace prgTW\AdventOfCode2020\Day4;

$input = file_get_contents('day4.txt');

$expectedFields   = [
	'byr', // Birth Year
	'iyr', // Issue Year
	'eyr', // Expiration Year
	'hgt', // Height
	'hcl', // Hair Color
	'ecl', // Eye Color
	'pid', // Passport ID
	'cid', // Country ID
];
$noExpectedFields = count($expectedFields);

/** @var array<array<string, string>> $passports */
$passports = array_map(
	static function (string $line): array {
		$fields = preg_split("/\s/", $line, -1, PREG_SPLIT_NO_EMPTY);
		$fields = array_map(
			static function (string $field): array {
				return explode(':', $field);
			},
			$fields
		);

		return array_combine(array_column($fields, 0), array_column($fields, 1));
	},
	explode("\n\n", $input)
);

$validPasswordsPart1 = array_filter(
	$passports,
	static fn(array $passport): bool => in_array(
		array_values(array_diff($expectedFields, array_keys($passport))),
		[[], ['cid']],
		true
	)
);

echo count($validPasswordsPart1), "\n";

// --- Part Two ---

/** @var array<string, callable> $isValidCbs */
$isValidCbs = [
	'byr' => static fn(string $data): bool => preg_match('/^19[2-9][0-9]|200[012]$/', $data),
	'iyr' => static fn(string $data): bool => preg_match('/^20(?:1[0-9]|20)$/', $data),
	'eyr' => static fn(string $data): bool => preg_match('/^20(?:2[0-9]|30)$/', $data),
	'hgt' => static fn(string $data): bool => preg_match(
		'/^(?:(?:15[0-9]|1[6-8][0-9]|19[0-3])cm|(?:59|6[0-9]|7[0-6])in)$/',
		$data
	),
	'hcl' => static fn(string $data): bool => preg_match('/^#[0-9a-f]{6}$/', $data),
	'ecl' => static fn(string $data): bool => in_array($data, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true),
	'pid' => static fn(string $data): bool => preg_match('/^[0-9]{9}$/', $data),
	'cid' => static fn(string $data): bool => true,
];

$validPasswordsPart2 = array_filter(
	$validPasswordsPart1,
	static function (array $passport) use ($isValidCbs): bool {
		foreach ($passport as $fieldName => $fieldValue) {
			if (true !== $isValidCbs[$fieldName]($fieldValue)) {
				return false;
			}
		}

		return true;
	}
);

echo count($validPasswordsPart2), "\n";
