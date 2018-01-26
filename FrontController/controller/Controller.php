<?php 
namespace woo\controller;
require ("../Registry/base/ApplicationRegistry.php");
require("ApplicationHelper.php");
require("CommandResolver.php");
use Registry\base;

class Controller{
	private $applicationHelper;
	
	private function __construct(){}
	
	static function run(){
		$instance = new Controller();
		$instance->init();
		$instance->handleRequest();
	}
	//Метод init()получает экземпляр класса под названием ApplicationHelper
	function init(){
		$applicationHelper = ApplicationHelper::instance();
		$applicationHelper->init();
	}
	
	function handleRequest(){
		$request = \Registry\base\ApplicationRegistry::getRequest();
		$cmd_r = new \woo\command\CommandResolver();
		$cmd = $cmd_r->getCommand($request);
		$cmd->execute($request);
	}
}










?>