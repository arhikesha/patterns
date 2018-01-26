<?php 

abstract class ApptEncode{
	abstract function Encode();
}

class BloggApptEncode extends ApptEncode{
	function Encode(){
		return "Данные о встрече закодированные в формате BloggCal \n";
	}
}

abstract class TtdEncode{
	abstract function Encode();
}

class BloggTtdEncode extends TtdEncode{
	function Encode(){
		return "Данные о встречи BloggCal";
	}
}

abstract class ContactEncode{
	abstract function Encode();
}
	
class BloggContactEncode extends ContactEncode{
		function Encode(){
			return "Контактные данные BloggCal";
		}
}	


abstract class CommsManager{
	abstract function getHeaderText();
	abstract function getBloggTtdEncode();
	abstract function getBloggContactEncode();
	abstract function getApptEncdoe();
	abstract function getFotterText();
}


class BloggsCommsManager extends CommsManager{
	function getHeaderText(){
		return "BloggCal вверхний колонтитул \n";
	}
	function getBloggTtdEncode(){
		return new BloggTtdEncode();
	}
	function getApptEncdoe(){
		return new BloggApptEncode();
	}
	function getBloggContactEncode(){
		return new BloggContactEncode();
	}
	function getFotterText(){
		return "BloggCal нижний колонтитул \n";
	}
}

$msq = new BloggsCommsManager();
 print $msq->getHeaderText();
 print $msq->getApptEncdoe()->Encode();
 print $msq->getFotterText();
 print $msq->getBloggContactEncode()->Encode();
 print $msq->getBloggTtdEncode()->Encode();
/////////////////////////////////////////////СМОТРИ СТР 214-215 РЕАЛИЗАЦИЯ ЧЕРЕЗ УСЛОВНЫЙ ОПЕРАТОР 

?>




