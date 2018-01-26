<?php 
abstract class Lesson{
	private $duration;
	private $costStrategy;
	
	public function __construct($duration , CostStrategy $strategy){
		$this->duration = $duration;//записываем время занятий
		$this->costStrategy = $strategy;//обьект типа CostStrategy
	}
	function cost(){
		return $this->costStrategy->cos($this);// явный вызов метода другого объекта для выполнения запроса называется ДЕЛЕГИРОВАНИЕМ 
	}
	function chargeType(){
		return $this->costStrategy->chargeType();
	}
	function getDuration(){
		return $this->duration;
	}
	function getCostStrategy(){
		return $this->costStrategy;
	}
}


class Lecture extends Lesson{
}

class Seminar extends Lesson{
}

abstract class CostStrategy{
	abstract function cos(Lesson $lesson);
	abstract function chargeType();
}

class TimedCostStrategy extends CostStrategy{
	
	function cos(Lesson $lesson){
		return ($lesson->getDuration() * 5);
	}
	function chargeType(){
		return "Почасовая оплата";
	}
}

class FixedCostStrategy extends CostStrategy{
	function cos(Lesson $lesson){
		return 30;
	}
		function chargeType(){
		return "Фиксированя ставка";
	}
}


class RegistrationMsg{
	function register(Lesson $lesson){
		//Что то делаем с обьектом Lesson
		
		$notifear = Notifear::getNotifear();
	//	var_dump ($notifear);
		//var_dump ($lesson->chargeType());
		$notifear->inform("Новое занятие стоимостью -({$lesson->cost()})");
		echo "Тип занятия". $lesson->chargeType();
	}
}


abstract class Notifear{
	static function getNotifear(){
	//Создадим соответствущий класс согласно конфигурации документа или другой логики
	if(rand(1,2) ===1){
		return new MailNotifear();
	}else{
		return new TextNotifear();
		}
	}
	abstract function inform($massage);
}

class MailNotifear extends Notifear{
	function inform($massage){
		print "Уведомление по Email : {$massage}\n";
	
		//var_dump ($massage);
	}
}

class TextNotifear extends Notifear{
	function inform($massage){
				print "Текстовое Уведомление : {$massage}\n";
	}
}

$lessons1 = new Seminar(7, new TimedCostStrategy());
$lessons2 = new Lecture (2, new FixedCostStrategy());
//var_dump($lessons1);
$msg = new RegistrationMsg();
$msg->register($lessons1);
echo "<br>";
$msg->register($lessons2);




?>