<?php 

class Product{
	public $name;
	public $price;
	
	function __construct($name,$price){
		$this->name = $name;
		$this->price = $price;
	}
}
	

class ProcessSale{
	private $callbacks;
	
	function registerCallback($callbacks){
		if(! is_callable($callbacks)){
			throw  new Exeption("Функция обратного вызова - невызывается");
		}
		$this->callbacks[] = $callbacks;
	}
	function sale( Product $product){
		print "{$product->name} - Обрабатывается....";
		foreach ($this->callbacks as $callback){
		call_user_func($callback,$product);
			
		}
	}
}
class Mailer{
	function doMail($product){
		print "Упаковываем - ".$product->name;
	}
}

$logger = function ($product){
		print"Записываем... ({$product->name}) \n";
};
echo "<pre>";
var_dump ($logger);
echo "</pre>";
$processor = new ProcessSale() ;
$processor->registerCallback($logger);

$processor->sale(new Product("Туфли",6));
echo "<br>";
$processor->sale(new Product("Кофу",6));

$product2 = new ProcessSale();
$product2->registerCallback( array( new Mailer(),"doMail"));


$product2->sale(new Product("Туфли",6));
echo"<br>";
echo "<pre>";
var_dump ($product2);
echo "</pre>";
?>