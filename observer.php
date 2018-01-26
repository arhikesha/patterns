<?php

interface Observable{
	function attach( Observer $observer);
	function detach( Observer $observer);
	function notify();
}

class Login implements Observable{
	private $observers = array();
	private $storage;
	private $status = array();
	const LOGIN_USER_UNKNOWN = 1;
	const LOGIN_WRON_PASS = 2;
	const LOGIN_ASSECC = 3;

	function __construct(){
		$this->observers = array();
	}
	
	function attach(Observer $observer){
		$this->observers[] = $observer;
	}
	
	function detach(Observer $observer){
		$this->observers = array_filter($this->observers,
																		function($a) use ($observer){
																			return (!($a === $observer) );	}	);													
	}
	function notify(){
		foreach ($this->observers as $obs){
			$obs->update($this);
		}
	}
	
	function headleLogin($user, $pass, $ip){
		$isvalid = false;
		switch (rand(1,3) ){
			case 1:
			$this->setStatus(self::LOGIN_ASSECC, $user, $ip);
			$isvalid = true;
			break;
			case 2:
			$this->setStatus(self::LOGIN_WRON_PASS, $user, $ip);
			$isvalid = false;
			break;
			case 3:
			$this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
			$isvalid = false;
			break;
		}
		$this->notify();
		return $isvalid;
	}
	private function setStatus($status,$user,$ip){
		$this->status = array($status,$user,$ip);
	}
	function getStatus(){
		return $this->status;
	}
}




interface Observer {
	function update (Observable $observable);
}

abstract class LoginObserver implements Observer{
	private $login;
	
	function __construct(Login $login){
		$this->login = $login;
		$login->attach($this);
	}
	
	function update(Observable $observable){
		if($observable === $this->login){
			$this->doUpdate($observable);
		}
	}
	abstract function doUpdate(Login $login);
}

class SecurityMonitor extends LoginObserver{
	function doUpdate(Login $login){
		$status = $login->getStatus();
		if($status[0] == Login::LOGIN_WRON_PASS){
			//Отправим почту администратору
			print __CLASS__ .":\t отправка почты сисАдмину "."<br>";
		}
	}
}

class GeneralLogger extends LoginObserver{
	function doUpdate(Login $login){
		$status = $login->getStatus();
		//var_dump($status);
			//Регистрация в системном журнале
			print __CLASS__ .":\t Регистрация в системном журнале \n"."<br>";
	}
}

class PathernshipTool extends LoginObserver{
	function doUpdate(Login $login){
		$status = $login->getStatus();
		//Проверка ip-адреса
			//отправка cookie, если адрес соответсвует списку
			print __CLASS__ .":\t отправка cookie, если адрес соответсвует списку\n"."<br>";
	}
}

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PathernshipTool($login);
//new PathernshipTool($login);
/*
echo "<pre>";
var_dump($login);
echo "</pre>";
*/
$login->headleLogin("oleg","pass",23);

echo "<pre>";
var_dump($login);
echo "</pre>";

?>