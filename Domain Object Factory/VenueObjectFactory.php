<?php 
namespace woo\mapper;
require_once("DomainObjectFactory.php");
require_once("DomainObject.php");

class VenueObjectFactory extends DomainObjectFactory{
	function createObject(array $array){
		$obj = new \woo\domain\Venue($array['id'] );
		$obj->setName( $array['name']);
		return $obj;
	}
}



?>