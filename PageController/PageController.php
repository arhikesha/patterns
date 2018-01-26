<?php 
namespace foo\base;

abstract class PageController{
	
	abstract function process();
	
	function forward ($resource){
		include($resource);
		exit(0);
	}
	
	function getRequest(){
		return \foo\base\ApplicationRegistry::getRequest();
	}
}





?>