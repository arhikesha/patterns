<?php 
namespace woo\mapper;

require_once("Collection.php");
require_once("CollectionGenerator.php");
//require_once("VenueMapper.php");
require_once("SpaceMapper.php");
require_once("../Domain Model/DomainObject.php");
include_once('../IdentityMap/ObjectWatcher.php');

////Iterator/////////////////
class SpaceCollection extends Collection{
	function targetClass(){
		return "\woo\domain\Space";
	}
}

/////GENERATOR/////////////
//class VenueCollectionGen extends CollectionGenerator{
//	function targetClass(){
//		return "\woo\domain\Venue";
//	}
//}
///////////////////Iterator/////////////////


$space = new SpaceMapper();
echo"<pre>";
var_dump( $space->findByVenue(5) );
echo"</pre>";


?>