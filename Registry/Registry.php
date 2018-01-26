<?php 
class Registry{
	private static $instance = null;
	private $values = array();
	private $treeBuilder = null;
	private $conf = null;
	private static $testmode;
	
	private function __construct(){}
	//метод для тестирования
	static function testMode($mode = true){
		self::$instance = null;
		self::$testmode = $mode;
	}
		//Измененый  instance метод для тестирования
	static function instance(){
		if(is_null(self::$instance) ){
			if(self::$testmode){
				self::$instance = new MockRegistry();
			}else{
				self::$instance = new self();
						}
		}
		return self::$instance;
	}
	
	function get($key){
		if( isset($this->values[$key]) ){
			 return $this->values[$key];
			}
		return null;
	}
	
	function set( $key, $value){
		$this->values[$key] = $value;
	}
	
	function treeBuilder(){
		if(is_null($this->treeBuilder) ){
								$this->treeBuilder = new TreeBuilder(
													$this->conf()->get('treedir') );
		}
		return $this->treeBuilder;
	}
	
	function conf(){
		if(is_null($this->conf ) ){
								$this->conf = new Conf();
		}
		return $this->conf;
	}

}

class MockRegistry extends Registry{
	//public $name = "oleg";
}

//Тестированиый метод 

//Registry::testMode();
$mockreg = Registry::instance();
//var_dump($mockreg);
$mk = MockRegistry::instance();
$mockreg->set('one',$mk );
echo "<pre>";
var_dump ($mockreg->get('one') );
echo "</pre>";
?>