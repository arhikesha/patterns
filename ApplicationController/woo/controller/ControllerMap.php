<?php 
namespace AppController\woo\controller;

class ControllerMap{
	private $viewMap = array();
	private $forwardMap = array();
	private $classrootMap = array();
	
	function addClassroot($command, $classroot){
		$this->classrootMap[$command] = $classroot;
	}
	
	function getClassroot($command){
		if(isset($this->classrootMap[$command]) ){
				return $this->classrootMap[$command];
		}
		return null;
	}
	
	function addView($view, $command='default', $status=0){
		$this->viewMap[$command][$status]=$view;
	}
	
	function getView($command, $status){
		if(isset( $this->viewMap[$coomand][$status]) ){
			return $this->viewMap[$command][$status];
		}
	}
	
function addForward($command, $status=0, $newCommand){
	$this->forwardMap[$command][$status]=$newCommand;
	}
	
	function getForward($command, $status){
		if(isset ($this->forwardMap[$command][$status]) ){
			return $this->forwardMap[$command][$status];
		}
		return null;
	}
}



$map = new ControllerMap();
$a = $map->addView('addvenue','AddVenue',0);

var_dump ($map->getView('AddVenue',0) );




?>