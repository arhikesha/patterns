<?php 
namespace AppController\woo\command;
include('command.php');

class AddVenue extends Command{
	
	function doExecute(\AppController\woo\controller\Request $request){
		$name = $request->getProperty("venue_name");
		if(is_null($name) ){
			$request->addFedback("Имя не задано");
			return self::statuses("CMD_INSUFFICIENT_DATA");
		}else{
			$venue_obj = new \AppController\woo\domain\Venue(null, $name);
			$request->setObject('venue', $venue_obj);
			$request->addFedback("'$name' добавленно в ({$venue_obj->getId()})");
			return self::statuses('CMD_OK');
		}
	}
}

?>