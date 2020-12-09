<?php

namespace prgTW\AdventOfCode2020\Impl;

use prgTW\AdventOfCode2020\Impl\Contracts\AbstractDayChallenge;

class Day4 extends AbstractDayChallenge
{
	/** @var array<string> */
	private const EXPECTED_FIELDS = [
		'byr', // Birth Year
		'iyr', // Issue Year
		'eyr', // Expiration Year
		'hgt', // Height
		'hcl', // Hair Color
		'ecl', // Eye Color
		'pid', // Passport ID
		'cid', // Country ID
	];

	/** @var array<array<string, string>> $passports */
	private array $passports;

	public function __construct(string $inputFilePath)
	{
		parent::__construct($inputFilePath);
		$this->passports = array_map(
			static function (string $line): array {
				$fields = preg_split("/\\s/", $line, -1, PREG_SPLIT_NO_EMPTY);
				$fields = array_map(
					static function (string $field): array {
						return explode(':', $field);
					},
					$fields
				);

				return array_combine(array_column($fields, 0), array_column($fields, 1));
			},
			explode("\n\n", $this->input)
		);
	}

	public function part1()
	{
		return count($this->getValidPasswordsForPart1());
	}

	public function part2()
	{
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
			'ecl' => static fn(string $data): bool => in_array(
				$data,
				['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'],
				true
			),
			'pid' => static fn(string $data): bool => preg_match('/^[0-9]{9}$/', $data),
			'cid' => static fn(string $data): bool => true,
		];

		$validPasswordsPart2 = array_filter(
			$this->getValidPasswordsForPart1(),
			static function (array $passport) use ($isValidCbs): bool {
				foreach ($passport as $fieldName => $fieldValue) {
					if (true !== $isValidCbs[$fieldName]($fieldValue)) {
						return false;
					}
				}

				return true;
			}
		);

		return count($validPasswordsPart2);
	}

	/**
	 * @return array|array[]|\string[][]
	 */
	private function getValidPasswordsForPart1(): array
	{
		return array_filter(
			$this->passports,
			static fn(array $passport): bool => in_array(
				array_values(array_diff(self::EXPECTED_FIELDS, array_keys($passport))),
				[[], ['cid']],
				true
			)
		);
	}
}
