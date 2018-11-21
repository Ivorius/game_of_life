<?php
declare(strict_types=1);

namespace App;


class Generation
{

	private $world;

	public function __construct(World $world)
	{
		$this->world = $world;
		$this->execute();
	}

	private function execute(): void
	{
		$lives = $this->world->getLiveCells();
		foreach ($lives AS $liveCell) {
			$this->resolveDestiny($liveCell);
		}

		$dies = $this->world->getDieCells();
		foreach($dies AS $dieCell) {
			$this->resolveDestiny($dieCell);
		}

		$this->bornNewGeneration();
	}

	private function resolveDestiny(Cell $cell): void
	{
		$neighbours = $this->world->getNeighbours($cell);
		$count = $this->world->countLiveCells($neighbours);
		$this->setMarkByRules($cell, $count);
	}

	public function setMarkByRules(Cell $cell, $countLive)
	{
		if ($cell->isLive() && $countLive < 2) {
			$cell->setMark(Cell::DIE);
		} elseif ($cell->isLive() && $countLive > 3) {
			$cell->setMark(Cell::DIE);
		} elseif( !$cell->isLive() && $countLive === 3) {
			$cell->setMark(Cell::LIVE);
		}
	}


	public function bornNewGeneration()
	{
		$cells = $this->world->getCells();
		foreach (
			array_filter($cells, function (Cell $value) {
				return $value->hasMark();
			}) AS $cell) {
			/** Cell $cell */

			if($cell->getMark() === Cell::DIE) {
				$cell->die();
			} else {
				$cell->live();
			}
		};
	}

}
