<?php 
interface IdentityObject{
	public function generateId();
}

trait IdentityTrait {
	public function generateId(){
	return uniqid();
	}
}

trait PriceUtilites{
private $taxrate = 17;

function calculateTax ( $price ) {
	return (($this->taxrate / 100) * $price ) ;
	}
}

class ShopProduct implements IdentityObject{
	use IdentityTrait,PriceUtilites;
} 

function storeidentityObject(IdentityObject $idobj ) {
	
}

$calc = new ShopProduct () ;
storeidentityObject($calc) ;
echo $calc->calculateTax(100);
echo "<br>";
echo $calc->generateId();


////СТатические трейды

trait PriceUtilite{
	private static $taxrat = 17;
	
	public static function calculatTax( $price ) {
	return ((self::$taxrat / 100) * $price ) ;
	}
}
abstract class Serviece{
	
}
class UtitiService extends Serviece{
	use PriceUtilite;
}
echo "<br>";
$n = new UtitiService();
print $n::calculatTax(100);


///Абстрактные методы в трейдах

trait PriceDiscont{
	
	public  function  calculatDisc($price){
		return ($this->getTaxRate()/100 * $price);
	}
	abstract function getTaxRate();
}
abstract class Serviec{
}

class UnitService extends Serviec{
	use PriceDiscont;
	public function getTaxRate(){
		return 17;
	}
}
$d = new UnitService();
echo "<br>";
print $d->calculatDisc(20);

//МОДИфикатор доступа трейдов

trait PriceDisconte{
	
	public  function  calculatDiscont($price){
		return ($this->getTaxRat()/100 * $price);
	}
	abstract function getTaxRat();
}

abstract class Service{
}



class UnitServices extends Service{
	
	use PriceDisconte{
	PriceDisconte::calculatDiscont as private;
	}
	private $price;
	
	function __construct($price){
		return $this->price = $price;
	}
	
		public function getTaxRat(){
		return 17;
	}
	function getFinalPrice(){
		return $this->price + $this->calculatDiscont($this->price);
	}
}

	
$pr = new UnitServices(10);
echo "<br>";
print $pr->getFinalPrice();
	
	

	
	
	
	
	
	
	
	
	
?>