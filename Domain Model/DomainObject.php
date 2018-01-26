<?php 
namespace woo\domain;
require_once("HelperFactory.php");
require_once("../IdentityMap/ObjectWatcher.php");


abstract class DomainObject{
	private $id = -1;
	
	function __construct($id=null){
	if(is_null($id) ){
		$this->markNew();
	}else{
		$this->id = $id;
		}
	}
	
	function markNew(){
		ObjectWatcher::addNew($this);
	}
	
	function markDelete(){
		ObjectWatcher::addDelete($this);
	}
	
	function markDirty(){
		ObjectWatcher::addDirty($this);
	}
	
	function markClean(){
		ObjectWatcher::addClean($this);
	}
	
	function setId($id){
		$this->id = $id;
	}
	
	function getId(){
		return $this->id;
	}
	
	static function getCollection($type){
		if( is_null($type) ){
			return HelperFactory::getCollection(get_called_class() );
		}
		return HelperFactory::getCollection($type);
	}
	
	static function collection(){
		return self::getCollection(get_class($this) );
	}
	
	function finder(){
		return self::getFinder(get_class($this) );
	}
	
	static function getFinder($type=null){
		if(is_null($type) ){
			return HelperFactory::getFinder(get_called_class() );
		}
		return HelperFactory::getFinder($type);
	}
	
}

class Venue extends DomainObject{
	private $name;
	private $spaces;
	
	function __construct($id=null, $name=null){
		$this->name = $name;
		$this->spaces = self::getCollection("\\woo\\domain\\Space");
		parent::__construct($id);
	}
	//Для добавления места нужно создать и передать обьет тима SpaceCollection
	function setSpaces( $spaces){
		$this->spaces = $spaces;
	}
	
	function getSpaces(){
		if( is_null($this->spaces) ){
			$this->spaces = self::getCollection(Space::class);
		}
		return $this->spaces;
	}
	
	
	
	function addSpace(Space $space){
		//$this->getSpaces()->add($space);
		$space->setVenue($this);
	}
	
	function setName($name_s){
		$this->name = $name_s;
		$this->markDirty();
	}
	function getName(){
		return $this->name;
	}
}



class Space extends DomainObject{
	function setName($name_s){
		$this->name = $name_s;
		$this->markDirty();
	}
	
	function setVenue(Venue $venue){
		$this->venue = $venue;
		$this->markDirty();
	}
	
	function getEvents(){
		if(is_null ($this->events) ){
			$this->events = self::getFinder(Event::class)->findBySpaceId($this->getId() );
		}
		return $this->events;
	}
	
}




?>