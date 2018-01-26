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




$lessons[] = new Seminar(7, new TimedCostStrategy() );
$lessons[] = new Lecture(4, new FixedCostStrategy() );
$lessons[] = new Lecture(9,new TimedCostStrategy() );
/*echo "<pre>";
var_dump ($lessons);
echo "</pre>";*/

foreach ($lessons as $lesson){
	print "Плата за занятия :({$lesson->cost()})";

	print "Тип оплаты :({$lesson->chargeType()})";
		echo "<br>";
		echo "<pre>";
//var_dump ($lesson->getCostStrategy());
echo "</pre>";
}






?>