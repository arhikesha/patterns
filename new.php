<?php 
class Bar{
	private $arr = array();
	private $foo = array();
	public $fooo;
	
	function __construct($key,$val){
		$this->arr[$key] = $val;
	}
	function setArr($key,$val){
		$this->arr[$key] = $val;
	}
	function getArr(){
		return $this->arr;
	}
	
	function setFoo($key,$key_foo,$val_foo){
		$this->foo[$key] = new Foo($key_foo,$val_foo);
	}
	
	function getFoo(){
		return $this->foo;
	}
	
	function setFooo(){
		$this->fooo = new Foo('ooolleegg',1225);
	}
	
	function getFooo(){
		return $this->fooo;
	}
}


$bar = new Bar('oleg',26);
$bar->setArr('Nastya',25) ;
$bar->getArr() ;
var_dump($bar);
echo "<br>";
$bat = new Bar('Dima',28);
$bat->getArr() ;
var_dump($bat);
echo "<br>";


class Singleton{
	public static $instance;
	private $mass = array();
	
	private function  __construct(){}
	
	public static function Instance(){
		if(empty(self::$instance) ){
			self::$instance = new Singleton();
				}
		return self::$instance;
	}
	
	public function setMass($key,$val){
		$this->mass[$key] = $val;
	}
	
	public function getMass(){
		return $this->mass;
	}
}

$singl = Singleton::Instance();
$singl->setMass('Oleg',26);
var_dump($singl::$instance);
echo "<br>";
$singl2 = Singleton::Instance();
$singl2->setMass('Nastya',25);
var_dump($singl2);
echo "<br>";
var_dump($singl);

class Foo{
	private $massiv = array();
	
	function __construct($key,$val){
		$this->massiv[$key] = $val;
	}
	
	function Integ(){
		return 125;
	}
}
//$foo = new Foo('Zaharii','1991');


$bar->setFoo('one','Zaharii','1991');
echo "<br>";
var_dump($bar->getFoo() );
echo "<br>";
$bar->setFooo();
var_dump($bar->fooo->Integ() );
echo "<br>";
?>