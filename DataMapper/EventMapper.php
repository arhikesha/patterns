<?php 
/////////Lazy Load (Ленивая загрузка)
namespace woo\mapper;
require_once ("Mapper.php");
require_once ("SpaceMapper.php");

class EventMapper extends Mapper{
	function __construct(){
		parent::__construct();
		$this->selectStmt = self::$PDO->prepare(
												"SELECT * FROM venue WHERE id=?");
		$this->updateStmt = self::$PDO->prepare(
												 "UPDATE venue SET name=?, id=? WHERE id=?");
		$this->insertStmt = self::$PDO->prepare(
												"INSERT INTO venue (name) values( ? )");								
																					
	}
	
	function getCollection(array $raw){
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
		$object->setId($id);
	}
	
	function update(\woo\domain\DomainObject $object){
		$values = array($object->getName(),
										$object->getId(), $object->getId() );
		$this->updateStmt->execute($values);								
	}
	
	function selectStmt(){
		return $this->selectStmt;
	}
	
	function findSpaceId($s_id){
		return new DeferredEventCollection($this,
														$this->selectBySpaceStmt, array($s_id) );
	}
}










?>