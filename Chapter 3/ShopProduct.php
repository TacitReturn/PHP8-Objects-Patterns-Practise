<?php

	class ShopProduct
	{
		public $title;
		public $producerFirstName;
		public $producerMainName;
		public $price;
		public function __construct(string $title, string $producerFirstName, string $producerMainName, float $price)
		{
			$this->title = $title;
			$this->producerFirstName = $producerFirstName;
			$this->producerMainName = $producerMainName;
			$this->price = $price;
		}

		public function getProucer ()
		{
			return "{$this->producerFirstName} {$this->producerMainName}";
		}
	}

	class ShopProductWriter
	{
		public function write(ShopProduct $shopProduct)
		{
			$str = $shopProduct->title . ": " . $shopProduct->getProucer() . " (" . $shopProduct->price . " ) \n";
			print $str;
		}
	}

//	$product1 = new ShopProduct(price: 0.7, title: "Shop Catalogue");
	$product1 = new ShopProduct("My Antonia", "Willa", "Cather", 5.99);
	$writer = new ShopProductWriter();
	$writer->write($product1);

	$product = new ShopProduct("title", "first", "main", "4.22");
	$writer->write($product);