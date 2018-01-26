<?php 
namespace foo\base;
require("PageController.php");
require("ApplicationRegistry.php");

class AddVenueController extends PageController{
	
	function process(){
		try{
			$request = $this->getRequest();
			
			$name = $request->getProperty('venue_name');
			//var_dump($request);
			if(is_null($request->getProperty("submitted") ) ){
				$request->addFeedback("Выберите имя заведения");
				$this->forward('add_venue.php');
			}else if(is_null($name) ){
				$request->addFeedback("Имя должно быть обязательно задано");
				$this->forward('add_venue.php');
			}
			//Создадим обьект который затем можно добавить в БД
			$venue = new \foo\domain\Venue(null,$name);
			$this->forward("ListVenues.php");
		}catch(Exception $e){
			$this->forward('error.php');
		}
	}
}

$controller = new AddVenueController();
$controller->process();





?>