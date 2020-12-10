<?php

declare(strict_types=1);

namespace prgTW\AdventOfCode2020\Impl\Tools;

use Iterator;

/**
 * @link https://www.developerfiles.com/combinations-in-php/
 * @link https://stackoverflow.com/questions/3742506/php-array-combinations#answer-3742837
 */
class Combinations implements Iterator
{
	private $c;
	private $s;
	private $n = 0;
	private $k = 0;
	private $pos = 0;

	public function __construct($s, $k)
	{
		if (is_array($s)) {
			$this->s = array_values($s);
			$this->n = count($this->s);
		} else {
			$this->s = (string)$s;
			$this->n = strlen($this->s);
		}
		$this->k = $k;
		$this->rewind();
	}

	function key()
	{
		return $this->pos;
	}

	function current()
	{
		$r = [];
		for ($i = 0; $i < $this->k; $i++) {
			$r[] = $this->s[$this->c[$i]];
		}

		return is_array($this->s) ? $r : implode('', $r);
	}

	function next()
	{
		if ($this->_next()) {
			$this->pos++;
		} else {
			$this->pos = -1;
		}
	}

	function rewind()
	{
		$this->c   = range(0, $this->k);
		$this->pos = 0;
	}

	function valid()
	{
		return $this->pos >= 0;
	}

	private function _next(): bool
	{
		$i = $this->k - 1;
		while ($i >= 0 && $this->c[$i] == $this->n - $this->k + $i) {
			$i--;
		}
		if ($i < 0) {
			return false;
		}
		$this->c[$i]++;
		while ($i++ < $this->k - 1) {
			$this->c[$i] = $this->c[$i - 1] + 1;
		}

		return true;
	}
}
