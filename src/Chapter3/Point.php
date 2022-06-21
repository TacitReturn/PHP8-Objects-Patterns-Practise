<?php

	class Point
	{
		private $x = 0;
		private $y = 0;

		public function setVals(int $x, int $y)
		{
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
	}

	$newPoint = new Point;
	$newPoint->setVals(5, 7);

	print($newPoint->getX()) . PHP_EOL;
	print($newPoint->getY()) . PHP_EOL;