<?php 

abstract class Unit{
	protected $dept = 0;
	
	function accept(ArmyVisitor $visitor){
		$method = "visit" . get_class($this);
		$visitor->$method($this);
	/*	echo "<pre>";
		var_dump($method);
		echo "</pre>";*/
	}
	
	protected function setDept($dept){
		$this->dept = $dept;
	}
	
	function getDept(){
		return $this->dept;
	}
}


abstract class CompositeUnit extends Unit{
	private $units = array();
	
	function getComposite(){
		return $this;
	}
	protected function units(){
		return $this->units;
	}
	function removeUnit(Unit $unit){
		$this->units = array_udiff($this->units,array($unit),
																function($a,$b){return $a===$b?0:1; } );
	}
	function addUnit(Unit $unit){
		foreach ($this->units as $thisunit){
			if($unit === $thisunit){
				return;
			}
		}
		$unit->setDept($this->dept+1);
		$this->units[] = $unit;
	}
		function bombardStrengt(){
		$ret = 0;
		foreach($this->units as $unit){
			$ret+=$unit->bombardStrengt();
		}
		return $ret;
	}
	
	function accept(ArmyVisitor $visitor){
		parent::accept($visitor);
		foreach($this->units as $thisunit){
			$thisunit->accept($visitor);
		}
	}
}


abstract class ArmyVisitor{
	abstract function visit(Unit $node);
	
	function visitArcher(Archer $node){
		$this->visit($node);
	}
	
	function visitCavalery(Cavalery $node){
		$this->visit($node);
	}
	
	function visitLaser(Laser $node){
		$this->visit($node);
	}
	
	function visitToopCarrier(ToopCarrier $node){
		$this->visit($node);
	}
	
	function visitArmy(Army $node){
		$this->visit($node);
	}
}


class TextDumpArmyVisitor extends ArmyVisitor{
	private $text = "";
	
	function visit(Unit $node){
		$txt = "";
		$pad = 4*$node->getDept();
		$txt .= sprintf("%{$pad}s","");
		$txt .= get_class($node).":";
		$txt .= "Огневая мощь:" .$node->bombardStrengt()."<br>";
		$this->text .=$txt;
	}
	function getText(){
		return $this->text;
	}
}

class TaxCollertionVisitor extends ArmyVisitor{
	private $due = 0;
	private $report = "";
	
	function visit(Unit $node){
		$this->levy($node, 1);
	}
	
	function visitArcher(Archer $node){
		$this->levy($node, 2);
	}
	
	function visitCavalery(Cavalery $node){
		$this->levy($node, 3);
	}
	
	function visitToopCarrier(ToopCarrier $node){
		$this->levy($node, 5);
	}
	
	function visitLaser(Laser $node){
		$this->levy($node, 12);
	}
	
	private function levy(Unit $unit, $amount){
		$this->report .= "Налог для " .get_class($unit);
		$this->report .= " : $amount"."<br>";
		$this->due +=$amount;
	}
	
	function getReport(){
		return $this->report;
	}
	
	function getTax(){
		return $this->due;
	}
}

class Archer extends Unit{
	function bombardStrengt(){
		return 4;
	}
}

class Cavalery extends Unit{
	function bombardStrengt(){
		return 22;
	}
}

class Laser extends Unit{
	function bombardStrengt(){
		return 18;
	}
}
class Army extends CompositeUnit{
}

class ToopCarrier extends CompositeUnit{}



$main_army =  new Army();
$main_army->addUnit(new Archer() );
$main_army->addUnit(new Laser() );
$main_army->addUnit(new Laser() );
$main_army->addUnit(new Cavalery() );
$main_army->addUnit(new Cavalery() );
$main_army->addUnit(new Cavalery() );

$sub_army = new Army();
$sub_army->addUnit(new Laser() );
$sub_army->addUnit($main_army);
$textdump = new TextDumpArmyVisitor();
$sub_army->accept($textdump);


/*
echo "<pre>";
var_dump ($textdump );
echo "</pre>";
*/
$textcollektor = new TaxCollertionVisitor();
$main_army->accept($textcollektor);

print $textcollektor->getReport()."<br>";
print "ИТОГО :";
print $textcollektor->getTax()."<br>";
echo "<br>";
print $textdump->getText();

echo "<pre>";
var_dump ($main_army );
echo "</pre>";






?>