<?php 
namespace woo\mapper;
require_once("UpdateFactory.php");
require_once("../Domain Model/DomainObject.php");

class VenueUpdateFactory extends UpdateFactory{
	function newUpdate(\woo\domain\DomainObject $obj){
		//Проверка тиов удалена
		$id = $obj->getId();
		$cond = null;
		$values['name'] = $obj->getName();
		if($id > -1){
			$cond['id'] = $id;
		}
		return $this->buildStatement("venue", $values,$cond);
	}
}


$vuf = new VenueUpdateFactory();
echo "<pre>";
print_r($vuf->newUpdate(new \woo\domain\Venue(334,"The Happe Hairdbar") ) );
echo "</pre>";




?>