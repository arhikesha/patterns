<?php
class StaticSimple{
	static public $num = 0;
	public $a;
	function __construct(){
		$this->a = 15;
	}
	static public function sayHello(){
		self::$num++;
		print "Hello(".self::$num. ")\n";
	}
	
}

StaticSimple::sayHello();
StaticSimple::sayHello();
$p = 'StaticSimple';
echo $p::sayHello();

$obj = new StaticSimple();
 $obj::$num = 14;
echo  $obj::$num ;
echo"<br>";
echo $p::sayHello();
//echo $p::$num;
//$q = new StaticSimple();
//echo $q->a;
//echo $q::$num;


?>