<?php
namespace woo\command;
//include_once("Command.php");

class ProductCommand extends Command{
	function doExecute(\woo\controller\Request $request){
	$request->addFeedback("Добро пожаловать в Woo! это ProductCommand с подключенным product view") ;
		include ("view/product.php");
	}
}








?>