<?php
/**
 * Author: Ivo Toman
 */

namespace Tests;


use Tester\Assert;

require __DIR__ . '/bootstrap.php';


/**
 * @testCase
 */
class Generation extends \Tester\TestCase
{

	public function testOneDie()
	{
		$world = new \App\World();
		$cell = (new \App\Cell(5, 5))->live();
		$world->addCell($cell);
		$world->getNeighbours($cell);
		$world->getCell('5,6')->live();

		new \App\Generation($world);

		Assert::false($cell->isLive());
	}

	public function testTwoOrThreeLive()
	{
		$world = new \App\World();
		$cell = (new \App\Cell(5, 5))->live();
		$world->addCell($cell);
		$world->getNeighbours($cell);
		$world->getCell('5,6')->live();
		$world->getCell('5,4')->live();

		new \App\Generation($world);

		Assert::true($cell->isLive());
	}

	public function testFourDie()
	{
		$world = new \App\World();
		$cell = (new \App\Cell(5, 5))->live();
		$world->addCell($cell);
		$world->getNeighbours($cell);
		$world->getCell('5,6')->live();
		$world->getCell('5,4')->live();
		$world->getCell('4,5')->live();
		$world->getCell('6,5')->live();

		new \App\Generation($world);

		Assert::false($cell->isLive());
	}

	public function testRevival()
	{
		$world = new \App\World();
		$cell = (new \App\Cell(5, 5))->die();
		$world->addCell($cell);
		$world->getNeighbours($cell);
		$world->getCell('5,6')->live();
		$world->getCell('5,4')->live();
		$world->getCell('4,5')->live();

		new \App\Generation($world);

		Assert::true($cell->isLive());
	}

	private function createWorld()
	{

	}

}

(new Generation())->run();


