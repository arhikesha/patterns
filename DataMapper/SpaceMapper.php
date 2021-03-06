<?php 
namespace woo\mapper;
require_once ("Mapper.php");


class SpaceMapper extends Mapper{
	function __construct(){
		parent::__construct();
		$this->selectAllStmt = self::$PDO->prepare("SELECT * FROM space");
		$this->findByVenueStmt = self::$PDO->prepare("SELECT * FROM space WHERE venue =?");
	}
	function	getCollection (array $raw){
		return new SpaceCollection($raw, $this);
	}
	
		protected function doCreateObject(array $array){
		$obj = new \woo\domain\Venue($array['id'] );//обьет с DomainModel
		$obj->setName($array['name']);
		$space_mapper = new SpaceMapper();
		$space_collection = $space_mapper->findByVenue($array['id'] );
		$obj->setSpaces($space_collection);
		return $obj;
	}
	
	protected function doInsert(\woo\domain\DomainObject $object){
		$values = array($object->getName() );
		$this->insertStmt->execute($values);
		$id = self::$PDO->lastInsertId();
		
	}
	
	function update(\woo\domain\DomainObject $object){
		$values = array($object->getName(),
										$object->getId(), $object->getId() );
		$this->updateStmt->execute($values);								
	}
	
	function selectStmt(){
		return $this->selectStmt;
	}
	
	function selectAllStmt(){
		return $this->selectAllStmt;
	}
	///Для IdentityMap
	protected function targetClass(){
		return \woo\domain\Space::class;
	}
}







?>