<?php 
namespace woo\process;

//include('Registry.php');
//include('/../controller/Request.php');


class ApplicationRegistry {
	private static $instance = null;
	private $freezedir = "data";
	private $values = array();
	private $mtimes = array();
	
	private function __construct(){}
	
	static function instance(){
		if(is_null(self::$instance) ){
								self::$instance = new self();
		}
		return self::$instance;
	}
	
	protected function get($key){
		$path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
		if(file_exists($path) ){
			clearstatcache();
			$mtime = filemtime($path);
			if(! isset($this->mtimes[$key]) ){
				$data = file_get_contents($path);
				$this->mtimes[$key] = $mtime;
				return ($this->values[$key] = unserialize($data) );
			}
		}
		if(isset($this->values[$key]) ){
			return $this->values[$key];
		}
		return null;
	}
	
	protected function set($key,$val){
		for($i=0;$i<count($val);$i++){
		$this->values[$key] = $val;
		//Изменил путь к файлу для работоспособности FrontController 
		//	$path = $this->freezedir .'/' .$key;
		$path = $this->freezedir .'/' .$key;
		file_put_contents($path,serialize($val) );
		$this->mtimes[$key] = time();
		}
	}
	
	static function getDSN(){
		return self::instance()->get('dsn');
	}
	
	static function setDSN( $dsn ){
		return self::instance()->set('dsn',$dsn);
	}

	static function getRequest(){
		$inst = self::instance();
		if(is_null($inst->get("request") ) ){
			//Изменил для работоспособности FrontController 
			$inst->set('request', new \woo\controller\Request());
		}
		return $inst->get("request");
	}
}

$app = ApplicationRegistry::instance();
//var_dump ($app::getRequest() );
//$app::setDSN('Nastya');
//var_dump($app::getDSN() );
//var_dump ($app->values);

$app2 = ApplicationRegistry::instance();
//var_dump ($app2::getRequest() );
$app2::setDSN('mysql:dbname=book;host=127.0.0.1') ;

//var_dump($app2::getDSN() );
//var_dump ($app2->values);


//const DNS = 'mysql:dbname=poker;host=127.0.0.1';
//const USER = 'root';
//const PASSWORD = 'password';
//print($app2::getDSN() );



?>