<?php
namespace woo\mapper;

class Field{
protected $name = null;
protected $operator = null;
protected $comps = array();
protected $incomplete = false;

//Устанавливает имя поля, например Age
	function __construct( $name ){
		$this->name = $name;
	}

	//Добавляет оператор и значение проверка 
	//(>40, например) и помещает его в свойство $comps
	function addTest( $operator, $value){
		$this->comps[] = array('name' => $this->name,
													'operator' => $operator,
															'value' => $value);
	}
	
	//$comps - это массив, поэтому мы можем сравнить  одно поле с другим
	// несколькими способами
	function getComps(){return $this->comps;}
	
	//Если массив $comps не содержит елементов, значит у нас есть
	//данные для сравнения и это поле не готово для использования в запросе
	function isIncomplete(){return empty($this->comps);}
}


?>