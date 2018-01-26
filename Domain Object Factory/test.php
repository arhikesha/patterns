<?php
require_once("VenueObjectFactory.php");
require_once("VenueMapper.php");


$venue = new woo\domain\Venue();
$venue_f = new woo\mapper\VenueObjectFactory();
echo "<pre>";
var_dump ($venue_f);
echo "</pre>";
/*
$prod_class = new ReflectionClass($venue);
echo "<pre>";
Reflection::export($prod_class);
echo "</pre>";
*/
$mapper = new woo\mapper\VenueMapper();
//$mapper = new \woo\mapper\VenueMapper();
//$venue = $mapper->find(5);
//echo "<pre>";
//print_r($venue);
//echo "</pre>";
//////////////////////
//$venue = new woo\domain\Venue();
$venue->setName('Oleg');
//// Добавим объект в базу данных
//$mapper->insert($venue);
//$venue = $mapper->find($venue->getId() );
echo "<pre>";
var_dump ($venue);
echo "</pre>";
//////////////////////////
//Снова найдем объект - просто для проверки, что все работает !
//$venue = $mapper->find(42);
//$venue->setName("bon");
//$mapper->update($venue);
//echo "<pre>";
//print_r($venue->getId() );
//echo "</pre>";


?>