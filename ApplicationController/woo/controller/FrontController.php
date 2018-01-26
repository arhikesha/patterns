<?php 
namespace AppController\woo\controller;
require ("ApplicationRegistry.php");
require("ApplicationHelper.php");

//require("CommandResolver.php");


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
		$request = \AppController\woo\controller\ApplicationRegistry::getRequest();
		$app_c =  \AppController\woo\controller\ApplicationRegistry::appController();
		
		while ($cmd = $app_c->getCommand($request) ){
			$cmd->execute($request);
		}
		$this->invokeView($app_c->getView($request) );
	}
	
	function invokeView($target){
		include("woo/view/$target.php");
		exit;
	}
}










?>