<?php 
/*
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
	public function __clone(){
			$this->id = 0;
	} 
}

$person = new Person("oleg",25);
$person->setId(6);

$person2 = clone $person;
var_dump($person2);
*/

class Account{
	public $balance;
	
	function __construct($balance){
		$this->balance = $balance;
	}
}

class Person{
	private $name;
	private $age;
	private $id;
	public $account;
	
	public function __construct ($name,$age,Account $account){
		$this->name = $name;
		$this->age = $age;
		$this->account = $account;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function __clone(){
			$this->id = 0;
			$this->account = clone $this->account;
	} 
}


$person = new Person("oleg",25,new Account(100));
$person->setId(32);
$person2 = clone $person;

$person->account->balance+=10;

echo"<pre>";
var_dump ($person->account);
echo"</pre>";

/*
abstract class Oper{
}



class My extends Oper{
	public  $a;
	
	public function __construct($a){
		return $this->a = $a;
	}
	public function getA(){
		return $this->a;
	}
}
class You{
	public function getYou(Oper $getYou){
	return  "{$getYou->a}" * 7 ;
	 
	}
}



$my = new My(5);

$you = new You;
var_dump ($you->getYou($my));*/
















?>