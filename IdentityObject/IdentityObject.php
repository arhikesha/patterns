<?php 
namespace woo\mapper;
require_once("Field.php");
class IdentityObject{
	protected $currentfield = null;
	protected $fields = array();
	private $and = null;
	private $enforce = array();
	
	//Конструктор identity object может запускатся 
	//без параметров или с именем поля
	function __construct($field=null,array $enforce=null){
		if( !is_null ($enforce) ){
			$this->enforce = $enforce;
		}
		if( !is_null($field) ){
			$this->field($field);
		}
	}
	
	//Имена полей на которое наложено это ограничение
	function getObjectFields(){
		return $this->enforce;
	}
	
	//Вводим новое поле
	//Генерируется ошибка,если текущее поле не наполное
	//(т.е age, а не age >40 ).
	//Этот метод возвращает ссылку на текущий обьект 
	//и тем самым разрешает свободный синтаксис
	function field($fieldname){
		if( ! $this->isVoid() && $this->currentfield->isIncomplete() ){
			throw new \Exception ("Неполное поле");
		}
		$this->enforceField($fieldname);
	if(isset ($this->fields[$fieldname]) ){
			$this->currentfield = $this->fields[$fieldname];
		}else{
			$this->currentfield = new Field($fieldname);
			$this->fields[$fieldname] = $this->currentfield;
		}
		return $this;
	}
	//Есть ли уже поля у IdentityObject
	function isVoid(){
		return empty($this->fields);
	}

	//Заданное имя поля допустимо?
	function enforceField($fieldname){
		if( !in_array($fieldname,$this->enforce) &&  ! empty($this->enforce) ){
			$forcelist = implode (',', $this->enforce);
			throw new \Exception ("{$fieldname} не является корректным полем ($forcelist)");
		}
	}
	
	//Добавим оператор равенства к текущему полю
	//т.е 'age' становиться Age = 40.
	//Возвращает ссылку на текущий обьект (с помощью operator())
	function eq($value){
		return $this->operator("=",$value); 
		}
	
	//Меньше чем 
	function It($value){
		return $this->operator("<",$value);
	}
	
	//больше чем
	function gt($value){
		return $this->operator(">",$value);
	}
	
	//Выполняет работу для методов operator.
	//получает ткущее поле и добавляет значение оператора
	//и результаты проверки к нему
	private function operator($symbol,$value){
		if($this->isVoid() ){
			throw new \Exception("Поле не определено");
		}
		$this->currentfield->addTest($symbol,$value);
		return $this;
	}
	
	//Возвращает все сравнения, созданных до сих пор в ассоциативном массиве
	function getComps(){
		$comparisons = array();
		foreach ($this->fields as $key => $field){
			$comparisons = array_merge($ret,$field->getComps() );
		}
		return $comparisons;
	}
	
}

class VenueIdentityObject extends IdentityObject{
		function __construct($field=null){
		parent::__construct($field,array('name','id') );
	}
}


class EventIdentityObject extends IdentityObject{
	/*private $start = null;
	private $minstart = null;
	
	function setMinimumStart($minstart){
		$this->minstart = $minstart;
	}
	
	function getMinimumStart(){
		return $this->minstart;
	}
	
	function setStart($start){
		$this->start = $start;
	}
	
	function getStart(){
		return $this->start;
	}*/
	
	function __construct($field=null){
		parent::__construct($field,array('name','id','start','duration','space') );
	}
}


/*
$idobj = new EventIdentityObject();
$idobj->setMinimumStart(time() );
$idobj->setName("A Fine Show");

$comps = array();
$name = $idobj->getName();
if(! is_null($name) ){
	$comps[] = "name = '{$name}'";
}

$minstart = $idobj->getMinimumStart();
if( !is_null($minstart) ){
	$comps[] = "start > {$minstart}";
}

$start = $idobj->getStart();
if( !is_null ($start) ){
	$comps[] = "start = '{$start}'";
}


$clause = "WHERE" . implode("and",$comps);
*/
//var_dump ($comps);
//echo "<pre>";
//var_dump ($idobj);
//echo "</pre>";

////////////////////

$idobj = new IdentityObject();
//echo "<pre>";
//var_dump ($idobj->field("name")->eq("The Good Show")
//					->field("start")->gt(time() )->It(time()+(24*60*60) ) );
//echo "</pre>";

$event = new EventIdentityObject();
//если не field("name") - выдаст исключение не правильного поля
$event->field("name")->eq("lucia");



?>