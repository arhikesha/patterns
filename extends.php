<?php
class ShopProduct{
public $title;
private $producerMainName ;
private $producerFirstName ;
protected $price;
private $discount = 0 ;
	
	public function __construct($title,$mainName,$firsName,$price){
		$this->title = $title;
		$this->producerMainName = $mainName;
		$this->producerFirstName = $firsName;
		$this->price = $price;
	}
	public function getProducerMainName(){
		return $this->producerMainName;
	}
	public function getProducerFirstName(){
		return $this->producerFirstName;
	}
	public function setDiscount ( $num ) {
		$this->discount=$num;
	}
	public function getDiscont(){
		return $this->discount;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getPrice(){
		return ($this->price - $this->discount);
	}
	
	public function getProducer(){
		return "{$this->producerFirstName} ".
	"{$this->producerMainName}";
	}
	public function sumaryLine(){
		$base = "{$this->title} ( {$this->producerFirstName}";
		$base.= "{$this->producerMainName})";
		return $base;
	}
}

	class CDProduct extends ShopProduct{
		public $lenghtCD ;
		
		public function __construct($title,$mainName,$firsName,$price,$playLength = null){
		
		parent::__construct ($title,$mainName,$firsName,$price);
			return $this->lenghtCD = $playLength;
		}
		public function getPleyLength(){
			return $this->lenghtCD;
		}
		public function sumaryLine(){
				$base = parent::sumaryLine();
				$base .= ":Время звучания - {$this->getPleyLength()}.'min'";
				return $base;
		}
	}
	
	class BookPage extends ShopProduct{
			private $nubPages ;
			
			public function __construct($title,$mainName,$firsName,$price,$nubPages = null){
			
		  parent::__construct ($title,$mainName,$firsName,$price);
			return $this->nubPages = $nubPages;
		}
		public function getBookPage(){
			return $this->nubPages;
		}
			public function sumaryLine(){
					$base = parent::sumaryLine();
					$base .= "{$this->nubPages} стр.";
					return $base;
		}

	}

class ShopProductWriter{
	public $products = array();
	
	public function addProduct(ShopProduct $shopProduct){
		$this->products[] = $shopProduct;
	}
	
	public function write(){
		$str = "";
		
		foreach ($this->products as $shopProduct){	
		$str = $shopProduct->sumaryLine() ."---".$shopProduct->getPrice().'grn';
		}
		print $str;
	}
}
$write = new ShopProductWriter();
$product2 = new CDProduct(" Пропавший без вести " ,"Группа " , "ДДТ " ,134,10.99 );
$product2->setDiscount(34);

$write->addProduct($product2);
$write->write($product2) ;
//var_dump ($write->products);
$product3 = new BookPage("Собачье сердце","Михаил","Булгаков",42,153);

echo "<br>";
$write->addProduct($product3);
$write->write($product3) ;

echo "<br>";
$product4 = new CDProduct("Охотник " ," Группа" , "Король и щут " ,421,10.99 );
//$product4->setDiscount(21);
call_user_func(array($product4,'setDiscount'),22);//динамически вызвани ,эквивалентно $product4->setDiscount(21)

$write->addProduct($product4);
$write->addProduct($product2);
echo"<pre>";
var_dump($write->products);
$obj = $write->products[2];
var_dump($obj->title);
echo"</pre>";
//$write->write($product4);
echo "<br>";
if(get_class($product4) == "CDProduct"){
	print "\$product4 - Обьек класса  CDProduct\n";
}
echo "<br>";
if($product4 instanceof ShopProduct ){
	print "\$product4 - Обьек типа  ShopProduct\n";
}
/*
echo "<br>";
echo "<pre>";
var_dump($write);
echo "</pre>";
*/




?>