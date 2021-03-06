<?php 
namespace woo\mapper;

abstract class CollectionGenerator {
	protected $mapper;
	protected $total = 0;
	protected $raw = array();
	private $result;
	private $objects = array();
	
	function __construct (array $raw = null, Mapper $mapper=null){
		if( ! is_null($raw) && ! is_null($mapper) ){
			$this->raw = $raw;
			$this->total = count($raw);
		}
		$this->mapper = $mapper;
	}
	
	function add(\woo\domain\DomainObject $objects){
		$class = $this->targetClass();
		if( ! ($objects instanceof $class) ){
			throw new Exception("Это коллекция {$class}");
		}
		$this->notifyAccess();
		$this->objects[$this->total] = $objects;
		$this->total++;
	}
	
	function getGenerator(){
		for($x = 0; $x<$this->total; $x++){
			yield($this->getRow($x) );
		}
	}
	
	
	abstract function targetClass();
	
	protected function notifyAccess(){
		//Сециально оставлена пустой
	}
	
	private function getRow($num){
		$this->notifyAccess();
		if($num >=$this->total || $num < 0){
			return null;
		}
		if(isset($this->objects[$num]) ){
			return $this->objects[$num];
		}
		if(isset($this->raw[$num]) ){
			$this->objects[$num] = $this->mapper->createObject($this->raw[$num] );
			return $this->objects[$num];
		}
	}
	
}




?>