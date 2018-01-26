<?php
namespace woo\command;
//include_once("Command.php");

class DefaultCommand extends Command{
	function doExecute(\woo\controller\Request $request){
	$request->addFeedback("Добро пожаловать в Woo! это DefaultCommand с подключенным main view") ;
		include ("view/main.php");
	}
}








?>