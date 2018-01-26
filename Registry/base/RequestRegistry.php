<?php
namespace Registry\base;

include('Registry.php');
include('../controller/Request.php');
use Registry\controller;

class RequestRegistry extends Registry{
	private $values = array();
	private static $instance = null;
	
	private function __construct(){}
	
 static function instance(){
		if(is_null(self::$instance) ){
								self::$instance = new self();
		}
		return self::$instance;
	}
	
	protected function get($key){
			if (isset( $this->values[$key]) ){
				return $this->values[$key];
		}
		return null;
	}
	
	protected function set($key,$val){
		$this->values[$key] = $val;
	}
	
	static function getRequest(){
		$inst = self::instance();
		if(is_null($inst->get("request") ) ){
			$inst->set('request', new \Registry\controller\Request());
		}
		return $inst->get("request");
	}
}


$req = RequestRegistry::instance();
//var_dump($req);
//var_dump ($req::getRequest() );
//var_dump ($req->get("request") );
//$user = $req::getRequest() ;
//var_dump ($user->user );
?>