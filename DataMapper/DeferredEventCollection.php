<?php 
/////////Lazy Load (Ленивая загрузка)
namespace woo\mapper;
require_once ('EventCollection.php');
class DeferredEventCollection extends EventCollection{
	private $stmt;
	private $valueArray;
	private $run=false;
	
	function __construct(Mapper $mapper, \PDOStatement $stmt_handle,
														array $valueArray){
		parent::__construct(null,$mapper);
		$this->stmt = $stmt_handle;
		$this->valueArray = $valueArray;
	}
	
	function notifyAccess(){
		if( ! $this->run){
			$this->execute($this->valueArray);
			$this->raw = $this->stmt->fetchAll();
			$this->total = count($this->raw);
		}
		$this->run = true;
	}
	function targetClass(){
		
	}
}


?>