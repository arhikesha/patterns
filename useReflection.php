<?php

class Person{
	public $name;
	
	public function __construct($name){
		$this->name = $name;
	}
}
interface Sale{
	
}
interface Modul{
	function execute();
}

class FtpModul implements Modul{
	public function setHost($host){
		print "FtpModul::setHost(): $host\n";
	}
	public function setUser($user){
		print "FtpModul::setUser(): $user\n";
	}
	public function execute(){
	}
}

class PersonModul implements Modul{
	public function setPerson(Person $person){
		print "PersonModul::setPerson():{$person->name}\n";
	}
	public function execute(){
	}
}
class MyClass implements Modul{
	public function setCalc($res){
		print "Результат подсчета MyClass : $res";
	}
	public function execute(){
	}
}

class ModulRunner{
	private $configDate = array(
												"PersonModul"	=>array("person"=>"oleg"),
												"FtpModul" =>array('host'=>'zachariy@gmail.com',
																						'user' =>'kesha'),
													"MyClass"=>array("calc"=>1991)									
													);
	public $modules = array();
	
	public	function init(){
		$interface = new ReflectionClass('Modul');//в переменной $interface  - У нас обьект класса ReflectionClass -интерфейся'Modul';
	//	var_dump($interface);
		foreach ($this->configDate as $modulname=>$params){
			// $modulname == PersonModul and FtpModul and MyClass///// $params == 	=>array("person"=>"oleg"), array('host'=>'zachariy@gmail.com','user' =>'kesha'"calc"=>1991)
			//var_dump($modulname);
			$module_class = new ReflectionClass($modulname);    /// создание трех   ReflectionClass для PersonModul and FtpModul and MyClass(это обьекты класса Reflection а не настоящие)
			//var_dump($module_class);
		
			if(!$module_class->isSubclassOf($interface)){              			
				throw new Exception("Неизвестный тип модуля: $modelname");
			}
			$module = $module_class->newInstance();			//создает экземляры классов PersonModul and FtpModul MyClass если он прошли проверку что являются подкласом или интерфейсом Modul
			//var_dump($module);
			foreach($module_class->getMethods() as $method ){
				//var_dump($method);
				//получаем методы обьектов класса PersonModul and FtpModul
				$this->handleMethod($module,$method,$params);
				//var_dump($params);
			}
		array_push($this->modules,$module);
		}
			
	} 
	public function handleMethod(Modul $module, ReflectionMethod $method, $params ){
		$name = $method->getName();// получаем все методы обьектов PersonModul and FtpModul
		$args = $method->getParameters();// получаем все параметры обьектов PersonModul and FtpModul
		if(count($args) != 1 || substr($name,0,3) !='set'){
			return false;
		}
		$property = strtolower (substr($name,3));
		//var_dump ($params[$property]);
		if(! isset ($params[$property])){
			return false;
			}
			$args_class = $args[0]->getClass();
			var_dump($args[0]);
			if(empty($args_class)){
				$method->invoke($module,$params[$property]);
				//var_dump($method);setHost
				//var_dump($module);
				//var_dump($params);
			}else{
				$method->invoke($module,
													$args_class->newInstance($params[$property]));
												//	var_dump($module);
			}
	}
}



$test = new ModulRunner();
echo "<pre>";
  $test->init();
echo "</pre>";


//echo "<pre>";
//  var_dump ($test->modules);
//echo "</pre>";


/*
function title_func($title, $name)
{
    return sprintf("%s. %s\r\n", $title, $name);
}

$name_func = new ReflectionFunction('title_func');
var_dump($invok);
echo $name_func->invoke('Dr', 'Phil');*/








?>