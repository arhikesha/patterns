<?php 
namespace woo\domain;

class ObjectWatcher{
	public $all = array();
	private $dirty = array();
	private $new = array();
	private $delete = array(); //В нашем примере не ипсользуется
	private static $instance = null;
	
	private function __construct(){ }
	
	static function instance(){
		if(is_null(self::$instance) ){
			self::$instance = new ObjectWatcher();
		}
		return self::$instance;
	}
	
	function globalKey(DomainObject $obj){
		$key = get_class($obj).".".$obj->getId();
		return $key;
	}
	
	static function add(DomainObject $obj){
		$inst = self::instance();
		$inst->all[$inst->globalKey($obj)] = $obj;
	}
	
	static function exists( $classname, $id){
		$inst = self::instance();
		$key = "{$classname}.{$id}";
		if(isset($inst->all[$key]) ){
			return $this->all[$key];
		}
		return null;
	}
	
	static function addDelete( DomainObject $obj){
		$self = self::instance();
		$self->delete[$self->globalKey($obj)] = $obj;
	}
	
	static function addDirty(DomainObject $obj){
		$inst = self::instance();
		if(!in_array($obj,$inst->new,true) ){
			$inst->dirty[$inst->globalKey($obj)] = $obj;
		}
	}
	
	static function addNew(DomainObject $obj){
		$inst = self::instance();
		//У нас еще нет идентификатора Id
		$inst->new[] = $obj;
	}
	
	static function addClean(DomainObject $obj){
		$self = self::instance();
		unset($self->delete[$self->globalKey($obj)] );
		unset($self->dirty[$self->globalKey($obj)] );
		$self->new = array_filter($self->new,
						function($a) use ($obj){return !( $a===$b);}
													);
	}
	
	function performOperations(){
		foreach ($this->dirty as $key=>$obj){
			$obj->finder()->update($obj);
		}
		foreach ($this->new as $key=>$obj){
			$this->finder()->insert($obj);
		}
		$this->dirty = array();
		$this->new = array();
	}
	
	
	
	
	
}




?>