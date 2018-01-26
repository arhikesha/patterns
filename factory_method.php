<?php

abstract class ApptEncode{
	abstract function Encode();
}

class BloggApptEncode extends ApptEncode{
	function Encode(){
		return "Данные о встрече закодированные в формате BloggCal \n";
	}
}

abstract class CommsManager{
	abstract function getHeaderText();
	abstract function getApptEncdoe();
	abstract function getFotterText();
}


class BloggsCommsManager extends CommsManager{
	function getHeaderText(){
		return "BloggCal вверхний колонтитул \n";
	}
	function getApptEncdoe(){
		return new BloggApptEncode();
	}
	function getFotterText(){
		return "BloggCal нижний колонтитул \n";
	}
}

$msq = new BloggsCommsManager();
 print $msq->getHeaderText();
 print $msq->getApptEncdoe()->Encode();
 print $msq->getFotterText();
////////////////////////WIKI
/**
 * Class Animal, со времен первой редакции книги прошло более 20 лет и этот паттерн немного эволюционировал,
 * и теперь всегда используют его сокращенную форму
 */
 /*
abstract class Animal
{
    // фабричный метод, который на основе типа возвращает объект
    public static function initial($animal)
    {
        return new $animal();
    }
    abstract public function voice();
}

class Lion extends Animal
{
    public function voice()
    {
        echo 'Rrrrrrrr i\'m the lion <br />' . PHP_EOL;
    }
}

class Cat extends Animal
{
    public function voice()
    {
        echo 'Meow, meow i\'m the kitty <br />' . PHP_EOL;
    }
}

$animal1 = Animal::initial('Lion');
$animal2 = Animal::initial('Cat');

$animal1->voice();
$animal2->voice();
*/
?>