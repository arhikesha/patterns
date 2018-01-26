<?php 

abstract class Tile{
	abstract function getWealtFactor();
}

class Plains extends Tile{
	private $wealfactor = 2;
	
	function getWealtFactor(){
		return $this->wealfactor;
	}
}

abstract class TileDecorator extends Tile{
	protected $tile;
	
	function __construct(Tile $tile){
		$this->tile = $tile;
	}
}	
	

class DiamantDecoration extends TileDecorator{
	function getWealtFactor(){
		return $this->tile->getWealtFactor() +2;
	}
}	
	
class PollutionDecoration extends TileDecorator{
	function getWealtFactor(){
		return $this->tile->getWealtFactor()-4;
	}
}	


$tile = new Plains();
var_dump ($tile->getWealtFactor());


$tile = new DiamantDecoration(new Plains() );
//echo"<pre>";
var_dump($tile->getWealtFactor());
//echo"</pre>";
$tile = new PollutionDecoration(new DiamantDecoration(new Plains() )   );
var_dump($tile->getWealtFactor() );

echo"<pre>";
var_dump($tile);
echo"</pre>";





/*
interface IText
{
    public function show();
}

class TextHello implements  IText
{
    protected $object;

    public function __construct(IText $text) {
        $this->object = $text;
    }

    public function show() {
        echo 'Hello';
        $this->object->show();
    }
}

class TextWorld implements  IText
{
    protected $object;

    public function __construct(IText $text) {
        $this->object = $text;
    }

    public function show() {
        echo 'world';
        $this->object->show();
    }
}

class TextSpace implements  IText
{
    protected $object;

    public function __construct(IText $text) {
        $this->object = $text;
    }

    public function show() {
        echo ' ';
        $this->object->show();
    }
}

class TextEmpty implements IText
{
    public function show() {
    }
}

$decorator = new TextHello(new TextSpace(new TextWorld(new TextEmpty())));
$decorator->show(); // Hello world
echo '<br />' . PHP_EOL;
$decorator = new TextWorld(new TextSpace(new TextHello(new TextEmpty())));
$decorator->show(); // world Hello
*/





	
?>