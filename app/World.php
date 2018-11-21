<?php
declare(strict_types=1);

namespace App;

class World
{

	private $cells = [];


	public function hasCells(): bool
	{
		return (bool)count($this->cells);
	}

	/**
	 * @return Cell[]
	 */
	public function getCells(): array
	{
		return $this->cells;
	}

	/**
	 * @param Cell $middle
	 * @return Cell[]
	 */
	public function getNeighbours(Cell $middle): array
	{
		$coordY = range(-1, 1);
		$coordX = range(-1, 1);

		$neighbours = [];

		foreach ($coordY AS $y) {
			foreach ($coordX AS $x) {
				$cell = new Cell($middle->getX() + $x, $middle->getY() + $y);
				$cell->die();

				if ($this->hasCell($cell)) {
					$cell = $this->cells[$cell->getHash()];
				} else {
					$this->addCell($cell);
				}

				$neighbours[$cell->getHash()] = $cell;
			}
		}

		unset($neighbours[$middle->getHash()]);

		return $neighbours;
	}

	public function hasCell(Cell $cell): bool
	{
		return array_key_exists($cell->getHash(), $this->cells);
	}

	public function addCell(Cell $cell): void
	{
		if ($this->hasCell($cell)) {
			throw new \InvalidArgumentException('Cell is in the world');
		}

		$this->cells[$cell->getHash()] = $cell;
	}


	public function getCell(string $hash): Cell
	{
		if(array_key_exists($hash, $this->cells) === false) {
			throw new \InvalidArgumentException('Cell isn´t in the world');
		}
		return $this->cells[$hash];
	}

	/**
	 * @return Cell[]
	 */
	public function getLiveCells(): array
	{
		return $this->filterLiveCells($this->cells);
	}

	/**
	 * @return Cell[]
	 */
	public function getDieCells(): array
	{
		return $this->filterDieCells($this->cells);
	}

	public function countLiveCells(array $cells): int
	{
		return count($this->filterLiveCells($cells));
	}

	/**
	 * @param array $cells
	 * @return Cell[]
	 */
	public function filterLiveCells(array $cells): array
	{
		return array_filter($cells, function (Cell $value) {
			return $value->isLive();
		});
	}


	/**
	 * @param array $cells
	 * @return Cell[]
	 */
	public function filterDieCells(array $cells): array
	{
		return array_filter($cells, function (Cell $value) {
			return $value->isLive() === false;
		});
	}

}
