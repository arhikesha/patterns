<?php 
//require_once("VenueMapper.php");
require_once("../Domain Model/DomainObject.php");
require_once("../IdentityMap/ObjectWatcher.php");
//require_once("Collection.php");
//require_once("CollectionGenerator.php");




//$mapper = new \woo\mapper\VenueMapper();
//$venue = $mapper->find(5);
//echo "<pre>";
//print_r($venue);
//echo "</pre>";
//////////////////////
//$venue = new woo\domain\Venue();
//$venue->setName('Oleg');
//// Добавим объект в базу данных
//$mapper->insert($venue);
//$venue = $mapper->find($venue->getId() );
//echo "<pre>";
//var_dump ($venue);
//echo "</pre>";
//////////////////////////
//Снова найдем объект - просто для проверки, что все работает !
//$venue = $mapper->find(42);
//$venue->setName("bon");
//$mapper->update($venue);
//echo "<pre>";
//print_r($venue->getId() );
//echo "</pre>";


$venue = new woo\domain\Venue(null,"Lucia");
$space = new woo\domain\Space(3,4);
$venue->addSpace(
				$space );
\woo\domain\ObjectWatcher::instance()->performOperations();
//$prod_class = new ReflectionClass($venue);
//echo "<pre>";
//Reflection::export($prod_class);
//echo "</pre>";





////////////////////Unit od Work
?>