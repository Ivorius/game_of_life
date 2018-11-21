<?php
declare(strict_types=1);

namespace Tests;

use Tester\Assert;

require __DIR__ . '/bootstrap.php';


/**
 * Class World
 * @testCase
 */
class World extends \Tester\TestCase
{

	public function testCells()
	{
		$world = new \App\World;
		Assert::type('array', $world->getCells());
		Assert::false($world->hasCells());

		$world->addCell(new \App\Cell(5, 5));
		Assert::true($world->hasCells());

		Assert::exception(function() use ($world) {
			$world->addCell(new \App\Cell(5, 5));;
		}, \InvalidArgumentException::class);
	}


	public function testNeighbours()
	{
		$world = new \App\World;
		$cell = new \App\Cell(5, 5);
		$world->addCell($cell);
		Assert::equal([
			'4,4' => (new \App\Cell(4,4))->die(), '5,4' => (new \App\Cell(5,4))->die(), '6,4' => (new \App\Cell(6,4))->die(),
			'4,5' => (new \App\Cell(4,5))->die(), '6,5' => (new \App\Cell(6,5))->die(),
			'4,6' => (new \App\Cell(4,6))->die(), '5,6' => (new \App\Cell(5,6))->die(), '6,6' => (new \App\Cell(6,6))->die()

		], $world->getNeighbours($cell));
	}


	public function testLiveCells()
	{
		$world = new \App\World;
		Assert::equal([], $world->getLiveCells());

		$cell = new \App\Cell(5, 5);
		$world->addCell($cell);

		$dieCell = new \App\Cell(6,6);
		$dieCell->die();
		$world->addCell($dieCell);
		Assert::equal(['5,5' => $cell], $world->getLiveCells());

		$cell2 = new \App\Cell(7,7);
		$world->addCell($cell2);
		Assert::equal(['5,5' => $cell, '7,7' => $cell2], $world->getLiveCells());

		Assert::equal(2, $world->countLiveCells($world->getCells()));
	}

	public function testCountLiveNeighbours()
	{
		$world = new \App\World;
		$cell = new \App\Cell(5, 5);
		$world->addCell($cell);
		Assert::equal(0, $world->countLiveCells($world->getNeighbours($cell)));

		$cell2 = $world->getCell('5,6')->live();
		Assert::equal(1, $world->countLiveCells($world->getNeighbours($cell)));

		$cellOutside = new \App\Cell(5, 7);
		$world->addCell($cellOutside);
		Assert::equal(1, $world->countLiveCells($world->getNeighbours($cell)));

		$cell3 = $world->getCell('4,5')->live();
		$cell4 = $world->getCell('6,5')->live();
		Assert::equal(3, $world->countLiveCells($world->getNeighbours($cell)));
	}





}


(new World)->run();
