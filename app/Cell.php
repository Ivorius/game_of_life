<?php
declare(strict_types = 1);

namespace App;

class Cell
{
	const LIVE = "live";
	const DIE = "die";

	private $x;
	private $y;
	private $live = true;

	private $mark;


	public function __construct(int $x, int $y) {
		$this->x = $x;
		$this->y = $y;
	}

	public function getX(): int
	{
		return $this->x;
	}

	public function getY(): int
	{
		return $this->y;
	}

	public function isLive(): bool
	{
		return $this->live;
	}


	public function live(): Cell
	{
		$this->live = true;
		return $this;
	}


	public function die(): Cell
	{
		$this->live = false;
		return $this;
	}

	public function getHash(): string
	{
		return $this->x . "," . $this->y;
	}


	public function setMark($mark): void
	{
		$this->mark = $mark;
	}

	public function hasMark(): bool
	{
		return $this->mark !== null;
	}

	public function getMark()
	{
		return $this->mark;
	}

}
