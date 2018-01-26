<?php 
namespace woo\mapper;
require_once("SelectionFactory.php");
require_once("../IdentityObject/IdentityObject.php");
require_once("../Domain Model/DomainObject.php");


class VenueSelectionFactory extends SelectionFactory{
	
	function newSelection(IdentityObject $obj){
		$fields = implode(',', $obj->getObjectFields() );
		$core = "SELECT $fields FROM venue";
		list($where,$values) = $this->buildWhere( $obj );
		return array($core." ".$where, $values);
	}
}


$vio = new VenueIdentityObject();
$vio->field("name")->eq("The happy Hairband");

$vsf = new VenueSelectionFactory();

print_r($vsf->newSelection($vio) );




?>