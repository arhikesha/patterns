<?php 
namespace AppController\woo\controller;
include("AppException.php");
include_once("ApplicationRegistry.php");


class ApplicationHelper{
	private static $instance = null;
	private $config = "controller/config.xml";
	
	private function __construct(){}
	
	static function instance(){
		if(is_null(self::$instance) ){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	function init(){
		$dsn = \AppController\woo\controller\ApplicationRegistry::getDSN();
		if(!is_null($dsn) ){
			return;
		}
		$this->getOptions();
	}
	public function getOptions(){
		$this->ensure(file_exists($this->config),
									"файл конфигурации не найден ");
		$options = @SimpleXml_load_file($this->config);
		var_dump($options);
		$dsn = (string)$options->dsn;
		$this->ensure($options instanceof SimpleXMLElement,
										"файл конфигурации запорчен");
		$this->ensure($dsn,"DSN не найден");
			\AppController\woo\controller\ApplicationRegistry::setDSN($dsn);
		//Установите другие значения
						
		$map = new ControllerMap ();
		///$options->control->view - XML
		foreach( $options->control as $default_view){
			$stat_str = trim($default_view['status']);
			$status = \AppController\woo\command::statuses($stat_str);
			$map->addView( (string)$default_view,'default', $status );
			//.....Анализ остальных кодов опущен
			\AppController\woo\controller\ApplicationRegistry::setControllerMap($map);
			//ДОПИСАТЬ МЕТОД В ApplicationRegistry::setControllerMap($map)
		}
	}
	
	private function ensure($expr, $message){
		if(!$expr){
			//Написать класс обработчика ошибок
		var_dump($message);
			
		}
	}
}


$ap = ApplicationHelper::instance();
var_dump($ap->getOptions() );




?>