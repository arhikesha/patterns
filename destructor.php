<?php 
class Person{
	private $name;
	private $age;
	public $id;
	
	public function __construct ($name,$age){
		$this->name = $name;
		$this->age = $age;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function __destruct(){
		if( empty($this->id)){
			print "Сохранение данных";
		}
	} 
}

$person = new Person("oleg",25);
$person->setId(0);


?>