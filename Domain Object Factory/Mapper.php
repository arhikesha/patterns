<?php 
namespace woo\mapper;
include_once('ApplicationRegistry.php');
//include_once('SpaceCollection.php');
//include_once('../IdentityMap/ObjectWatcher.php');
/////ПРЕОБРАЗОВУЕТ  СТРОК БАЗЫ В ОБЬЕКТ
abstract class Mapper{
	protected static $PDO;
	
	function __construct(){
		if(! isset(self::$PDO) ){
				$dsn = \woo\mapper\ApplicationRegistry::getDSN();
				if( is_null($dsn) ){
					throw new Exception ("DSN не определен");
				}
				self::$PDO = new \PDO($dsn,'root','password');
				self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
	//Проверка для IdentityMap
	
	private function getFormMap($id){
		return \woo\domain\ObjectWatcher::exists(
																$this->targetClass(),$id);
	}
	
	private function addToMap(\woo\domain\DomainObject $obj){
		return \woo\domain\ObjectWatcher::add( $obj );
	}
	
	function find($id){
		$old = $this->getFormMap($id);
		if(! is_null ($old) ){return $old;}
		$this->selectStmt()->execute(array($id) );
		$array = $this->selectStmt()->fetch();
		$this->selectStmt()->closeCursor();
		if( !is_array($array) ){return null;}
		if( !isset($array['id']) ) { return null;}
		$object = $this->createObject( $array );
		return $object;
	}
	
	function findAll(){
		$this->selectAllStmt()->execute( array() );
		return $this->getCollection(
						$this->selectAllStmt()->fetchAll(\PDO::FETCH_ASSOC) );
	}
	
	function findByVenue($vid){
		$this->findByVenueStmt->execute(array ($vid) );
		return new SpaceCollection(
							$this->findByVenueStmt->fetchAll(),$this);
	}
	
	function createObject($array){
		$old = $this->getFromMap( $array['id']);
		if( !is_null($old) ){return $old;}
		$obj = $this->doCreateObject($array);
		$this->addToMap($odj);
		$obj->markClean();
		return $obj;
	}
	
	function insert (\woo\domain\DomainObject $obj){
		$this->addToMap($obj);
		$this->doInsert($obj);
	}
	
	abstract function update(\woo\domain\DomainObject $object);
	protected abstract function doCreateObject(array $array);
	protected abstract function doInsert(\woo\domain\DomainObject $object);
	protected abstract function selectStmt();
	
}





?>