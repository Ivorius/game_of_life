<?php
declare(strict_types=1);

namespace Tests;

use Tester\Assert;
use Tester\TestCase;


require __DIR__ . '/bootstrap.php';


/**
 * @testCase
 */
class Cell extends TestCase
{

	public function testGetY()
	{
		$cell = $this->createCell();
		Assert::equal(5, $cell->getX());
	}

	private function createCell()
	{
		return new \App\Cell(5, 10);
	}

	public function testGetX()
	{
		$cell = $this->createCell();
		Assert::equal(10, $cell->getY());
	}

	public function testIfCellLive()
	{
		$cell = $this->createCell();
		Assert::true($cell->isLive());

		$cell->die();
		Assert::false($cell->isLive());

		$cell->live();
		Assert::true($cell->isLive());
	}

	public function testHash()
	{
		$cell = $this->createCell();
		Assert::equal('5,10', $cell->getHash());
	}
}


(new Cell())->run();
