<?php
class ShopProduct{
	public $title = "Название товара";
	public $producerMainName = "Фамилия автора";
	public $producerFirstName = "Имя автора";
	public $price  = "Цена";
	
	public function __construct($title,$mainName,$firsName,$price){
		$this->title = $title;
		$this->producerMainName = $mainName;
		$this->producerFirstName = $firsName;
		$this->price = $price;
	}
	
	public function getProduct(){
		return "{$this->producerFirstName} ".
	"{$this->producerMainName}";
	}
}

class ShopProductWriter{
	public function write(ShopProduct $shopProduct){
		$str = "{$shopProduct->title} ".
		"{$shopProduct->getProduct()} ".
			 "{$shopProduct->price}";
	print "{$str}";
	}
}



$product1 = new ShopProduct("Собачье сердце","Булгаков","Михаил","5.90");
var_dump ($product1);
echo"<br>";
$writer = new ShopProductWriter();
$writer->write($product1);



?>