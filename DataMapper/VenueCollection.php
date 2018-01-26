<?php 
namespace woo\mapper;
require_once("Collection.php");
require_once("CollectionGenerator.php");
require_once("VenueMapper.php");
//require_once("SpaceMapper.php");
require_once("../Domain Model/DomainObject.php");

////Iterator/////////////////
class VenueCollection extends Collection{
	function targetClass(){
		return "\woo\domain\Venue";
	}
}

/////GENERATOR/////////////
class VenueCollectionGen extends CollectionGenerator{
	function targetClass(){
		return "\woo\domain\Venue";
	}
}
///////////////////Iterator/////////////////

$mapper = new \woo\mapper\VenueMapper();

$collection = new VenueCollection();
//var_dump($collection );

$collection->add(new \woo\domain\Venue(55,"Loud and Thumping",32) );
$collection->add(new \woo\domain\Venue(54,"Eeezy") );
$collection->add(new \woo\domain\Venue(null,"Duck and Badger") );

foreach ($collection as $venue){
	//var_dump( $venue->getName()."\n");
	$mapper->update($venue);
}
echo"<pre>";
var_dump( $collection);
echo"</pre>";
/////////////////////////////////////////////GENERATOR/////////////


//$mapper_ger = new \woo\mapper\VenueMapper();
//
//$collection_gen = new VenueCollectionGen();
//$collection_gen->add(new \woo\domain\Venue(13,"Loud and Thumping",32) );
//$collection_gen->add(new \woo\domain\Venue(14,"Eeezy") );
//$collection_gen->add(new \woo\domain\Venue(15,"Duck and Badger") );
//$gen = $collection_gen->getGenerator();
//
//foreach ($gen as $wrapper){
//	print_r($wrapper);
//		$mapper_ger->update($wrapper);
//}
////////////////////HelperFactory/////////НЕ ПОНЯЛ КАК РЕАЛИЗОВАТЬ!!!
//$collection_factory = \woo\domain\Venue::getCollection();


?>