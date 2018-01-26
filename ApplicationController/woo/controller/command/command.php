<?php
namespace AppController\woo\command;

abstract class Command{
	private static $STATUS_STRINGS = array(
			'CMD_DEFAULT'=>0,
			'CMD_OK'=>1,
			'CMD_ERROR'=>2,
			'CMD_INSUFFICIENT'=>3
	);
	private $status = 0 ;
	
	final function __construct(){}
	
	function execute( \AppController\woo\controller\Request $request ){
		$this->status = $this->doExecute($request);
		$request->setCommand($this);
	}
	
	function getStatus(){
		return $this->status;
	}
	
	static function statuses ($str = 'CDM_DEFAULT'){
		if(isset($self::$STATUS_STRINGS[$str]) ){
			//Преобразуем скроку в код состоянния 
			return self::$STATUS_STRINGS[$str];
		}
		throw new \woo\base\Exeption ("Неизвестный код состоянния $str");
	}
	abstract function doExecute(\AppController\woo\controller\Request $request);
}


?>