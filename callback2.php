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
		print "{$product->name} - Обрабатывается...."."<br>";
		foreach ($this->callbacks as $callback){
		call_user_func($callback,$product);
		var_dump($this->callbacks);
			
		}
	}
}
class Mailer{
	function doMail($product){
		print "Упаковываем - ".$product->name;
	}
}

class Totalize{
	static function WarnAmount($amt){
		$count = 0;
		return function ($product) use ($amt,&$count){
			$count += $product->price;
				print "Сумма : {$count}"."<br>" ;
				if($count > $amt){
						print "Проданно товаров на сумму : {$count}"."<br>" ;
				}
		};
	}
}


$processor = new ProcessSale();
$processor->registerCallback(Totalize::WarnAmount(8));
$processor->sale(new Product("Туфли",6));
echo "<br>";
$processor->sale(new Product("Кофе",6));
?>