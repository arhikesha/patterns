<?php
/////////Lazy Load (Ленивая загрузка) 
namespace woo\mapper;


//С помощью Iterator ,Есть и с Generator
abstract class EventCollection implements \Iterator{
	protected $mapper;
	protected $total = 0;
	protected $raw = array();
	
	private $result;
	private $pointer = 0;
	private $objects = array();
	
	function __construct (Mapper $mapper, \PDOStatement $stmt_handle,
														array $valueArray){
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
	
	public function rewind(){
		$this->pointer = 0;
	}
	
	public function current(){
		return $this->getRow($this->pointer);
	}
	
	public function key(){
		return $this->pointer;
	}
	
	function next(){
		$row = $this->getRow($this->pointer);
		if($row){$this->pointer++;}
		return $row;
	}
	
	public function valid(){
		return ( ! is_null($this->current() ) );
	}
}




?>