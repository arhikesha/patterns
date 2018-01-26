<?php 
namespace woo\domain;
require_once("DomainObject.php");

abstract class HelperFactory{
	static function getCollection($type){
	}
	static function collection(){
	}
	static function getFinder($type){
	}
	static function finder(){
	}
}
interface VenueCollection extends \Iterator{
	function add (DomainObject $venue);
}

interface SpaceCollection extends \Iterator{
	function add (DomainObject $venue);
}

interface EventCollection extends \Iterator{
	function add (DomainObject $venue);
}


?>