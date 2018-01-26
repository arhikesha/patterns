<?php 
abstract class Question{
	protected $promt;
	protected $marker;
	
	function __construct ($promt, Marker $marker){
		$this->promt = $promt;
		$this->marker = $marker;
	}
	function mark($response){
		return $this->marker->mark($response);//mark - оценка
	}
}

class TextQuestion extends Question{
	//выполняется действия, специфичны для текстовых вопросов
}
class AVQuestion extends Question{
		//выполняется действия, специфичны для муьтимедийныx вопросов
}

abstract class Marker{
	protected $test;
	
	function __construct($test){
		$this->test = $test;
	}
	abstract function mark($response);
}

class MarkLogikMarker extends Marker{
	private $engine;
	
	function __construct($test){
		parent::__construct($test);
		//This->engine = new MarkParse($test);
	}
	function mark($response){
	//	return $this->engine->evaluter($response);
	//Возващаем фиктивное значение
		return true;
	}
}

class MathMarker extends Marker{
	function mark($response){
		return ($this->test == $response);
	}
}

class RegexpMarker extends Marker{
	function mark($response){
		return(preg_match($this->test,$response) );
	}
}

$markers = array(new RegexpMarker("/Пять/"),
								 new MathMarker("Пять"),
								 new MarkLogikMarker('$input equals "Пять"'));



foreach ($markers as $marker){
	print get_class($marker)."<br>";
	$question = new TextQuestion("Сколько звезд у кремлевской звезды?",$marker);
	//var_dump($question);
foreach (array("Четыри","Пять","One") as $response){
	print "Ответ: $response:";
	if($question->mark($response) ){
		print "правильно"."<br>";
	}else{
		print "не правильно"."<br>";
		}
	}
}								 
								 
?>