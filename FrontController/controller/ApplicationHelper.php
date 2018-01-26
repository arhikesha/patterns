<?php 
namespace woo\controller;
require_once ("../Registry/base/ApplicationRegistry.php");
//require ("../../Registry/controller/Request.php");
use Registry\base;
//use Registry\controller;


class ApplicationHelper{
	private static $instance = null;
	private $config = "data/woo_options.xml";
	
	private function __construct(){}
	
	static function instance(){
		if(is_null(self::$instance) ){
			self::$instance = new self();
		}
		return self::$instance;
	}
	//Принимает данные с файла dsn через общий метод ApplicationRegistry
	function init(){
		$dsn = \Registry\base\ApplicationRegistry::getDSN();
		if(!is_null($dsn) ){
			return;
		}
		$this->getOptions();
	}
	public function getOptions(){
		$this->ensure(file_exists($this->config),
									"файл конфигурации не найден ");
		$options = @SimpleXml_load_file($this->config);
		$dsn = (string)$options->dsn;
		$this->ensure($options instanceof SimpleXMLElement,
										"файл конфигурации запорчен");
		$this->ensure($dsn,"DSN не найден");
		\Registry\base\ApplicationRegistry::setDSN($dsn);
		//Установите другие значения
	}
	
	private function ensure($expr, $message){
		if(!$expr){
			//Написать класс обработчика ошибок
			throw new \woo\base\AppException($massage);
		}
	}
}








?>