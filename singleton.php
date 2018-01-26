<?php 

class Preference{
	private $props = array();
	private static $instance;
	
	private function __construct(){}
	
	public static function getInstance(){
		if (empty (self::$instance)){
			self::$instance = new Preference();
		}
		return self::$instance;
	}
	
	public function setProperty($key,$val){
		$this->props[$key] = $val;
	}
	
	public function getProperty($key){
		return $this->props[$key];
	}
}

$pref = Preference::getInstance();
$pref->setProperty("name","oleg");
$pref->setProperty("name2","oleg2");
echo "<pre>";
var_dump ($pref);
echo "</pre>";
unset($pref);

$pref2 = Preference::getInstance();
$pref2->setProperty("family","zachariy");
print $pref2->getProperty("name2");
echo "<br>";
echo "<pre>";
var_dump ($pref2);
echo "</pre>";


?>