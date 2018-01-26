<?php 
//Command
abstract class Command{
	abstract public function Execute();
}
// * Класс конкретной "команды"(receiver)- приемник
class CalculatorCommand extends Command{
	/**
    * Текущая операция команды
    *
    * @var string
    */
			public $operator;
		
		/**
    * Первый операнд
    *
    * @var mixed
    */ 
		public $operand_one;
		
			/**
    * Второй операнд
    *
    * @var mixed
    */ 
		public $operand_two;
		/**
    * Класс, для которого предназначенна команда
    *
    * @var object of class Calculator
    */ 
		public $calculator;
		  /**
    * Конструктор
    * 
    * @param object $calculator
    * @param string $operator
    * @param mixed $operand 
    */
		public function __construct($calculator,$operator,$operand_one,$operand_two){
			$this->calculator = $calculator;
			$this->operator = $operator;
			$this->operand_one = $operand_one;
			$this->operand_two = $operand_two;
		}
		/**
    * Переопределенная функция parent::Execute()
    */ 
		public function Execute(){
			$this->calculator->Operation($this->operator,$this->operand_one,$this->operand_two);
		}
}
/**
  * Класс получатель и исполнитель "команд"(client)
  */

class Calculator{
	
	public $result;
	
	function Operation($operator,$operand_one,$operand_two){
		switch($operator){
			case '+':$this->result = $operand_one + $operand_two;
			break;
			case '-':$this->result = $operand_one - $operand_two;
			break;
			case '*':$this->result = $operand_one * $operand_two;
			break;
			case '/':$this->result = $operand_one / $operand_two;
			break;
		}
		return $this->result;
	}
}
 /**
  * Класс, вызывающий команды(invoker)
  */
class invoker{
	 /**
    * Этот класс будет получать команды на исполнение
    *
    * @private
    * @var object of class Calculator
    */
				public $calculator;
		
		public function __construct(){
			$this->calculator = new Calculator();
		}
		
		 /**
    * Функция выполнения команд
    */
			public function Compute($operator,$operand_one,$operand_two){
			// Создаем команду операции и выполняем её
			$command = new CalculatorCommand($this->calculator,$operator,$operand_one,$operand_two);
			$command->Execute();
		}		
}

$invok = new invoker();
$invok->Compute('+',23,53) ;	
	
	echo $invok->calculator->result;
//	echo "<pre>";
//var_dump($invok);
// 	echo "</pre>";



















?>