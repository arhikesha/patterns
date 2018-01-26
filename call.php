<?php 

class PersoneWrite{
	function writeName (Person $p){
		print $p->getName() ."\n " ;
}
		function writeAge(Person $p){
		print $p->getAge() ."\n " ;
}
}

class Person{
	private $writer;
	function __construct(PersoneWrite $writer){
			$this->writer  = $writer;
		//	var_dump($this->writer);
	}
	function __call($methodname, $args){
		if(method_exists($this->writer,$methodname)){
//var_dump($this->writer->$methodname($this));
			return $this->writer->$methodname($this);
		}
	}
function getName(){return "Oleg";}
function getAge(){return 25;}
}
$persone = new Person (new PersoneWrite());
//var_dump($persone);
$persone->writeName();
$persone->writeAge();
?>