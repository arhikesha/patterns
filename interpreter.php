<?php 

abstract class Expresion{
	private static $keycount = 0;
	private $key;
	
	abstract function interpret(InterpretContext $context);
	
	 function getKey(){
		if( ! isset($this->key)){
			self::$keycount++;
			$this->key = self::$keycount;
		}
		return $this->key;
	}
	function getKeyes(){
		return $this->key;
	}
}

class LiteralExpression extends Expresion{
	private $value;
	
	function __construct($value){
		$this->value = $value;
	}
	function interpret(InterpretContext $context){
		$context->replace($this,$this->value);
	}
}

class VariableExpression extends Expresion{
	private $name;
	private $val;
	
	function __construct($name,$val=null){
		$this->name = $name;
		$this->val = $val;
	}
	function interpret(InterpretContext $context){
		if( !is_null($this->val) ){
			$context->replace($this,$this->val);
			$this->val = null;
		}
	}
	
	function setValue($value){
		$this->val = $value;
	}
	
	function getKey(){
		return $this->name;
	}
}

abstract class OperationExpression extends Expresion{
	protected $l_op;
	protected $r_op;
	
	function __construct(Expresion $l_op, Expresion $r_op){
		$this->l_op = $l_op;
		$this->r_op = $r_op;
	}
	
	function interpret (InterpretContext $context){
		$this->l_op->interpret($context);
		$this->r_op->interpret($context);
		$result_l = $context->lookup($this->l_op);
		$result_r = $context->lookup($this->r_op);
		$this->doInterpret($context, $result_l, $result_r);
	}
	protected abstract function doInterpret(InterpretContext $context, $result_l, $result_r);
}

class EqualsExpression extends OperationExpression{
	protected function doInterpret(InterpretContext $context, $result_l, $result_r){
		$context->replace($this,$result_l == $result_r);
	}
}

class BooleanOrExpression extends OperationExpression{
	protected function doInterpret(InterpretContext $context, $result_l, $result_r){
		$context->replace($this,$result_l || $result_r);
	}
}
	
	class BooleanAndExpression extends OperationExpression{
	protected  function doInterpret(InterpretContext $context, $result_l, $result_r){
			$context->replace($this,$result_l && $result_r);
		}
	}




class InterpretContext{
	private $expressionstone = array();
	
	function replace(Expresion $exp, $value){
		$this->expressionstone[$exp->getKey()] = $value;
	}
	function lookup(Expresion $exp){
		return $this->expressionstone[$exp->getKey()];
	}
}




/*
$text = new InterpretContext();
//var_dump($text);
$liter = new LiteralExpression("oleg");
//var_dump($liter->getKeyes());
$liter->interpret($text);
//var_dump($liter);
//var_dump($text);

$variable = new VariableExpression('key',"Petya");
//var_dump($variable);
$variable->interpret($text);
$variable->setValue('Kolya');
$variable->interpret($text);
//var_dump($variable);
var_dump($text );
*/



/*
$context = new InterpretContext();
$literal = new LiteralExpression('Четыри');
$literal->interpret($context);
//var_dump($literal);
var_dump ($context->lookup($literal) );

$context2 = new InterpretContext();
$myvar = new VariableExpression('input','четыри');
$myvar->interpret($context2);
print $context2->lookup($myvar);//четыри

$newvar = new VariableExpression('input');
$newvar->interpret($context2);
print $context2->lookup($newvar);//четыри

$myvar->setValue('пять');
$myvar->interpret($context2);
print $context2->lookup($myvar);//пять
print $context2->lookup($newvar);//пять
var_dump($context2);
*/
/*
$context = new InterpretContext();
$input = new VariableExpression('input');
$statement = new BooleanAndExpression(
						new EqualsExpression($input, new LiteralExpression(4) ),
						new EqualsExpression($input, new LiteralExpression(4) )
						);
foreach(array ("четыри", 4, 3, "4",52) as $val){
	$input->setValue($val);
	print "$val: \n";
	$statement->interpret($context);
	if($context->lookup($statement)){
		print "Соответсвует" . "<br>";
	}else{
		print "не сооветсвует". "<br>";
	}
}
*/

$text = new InterpretContext();
$key = new VariableExpression('key');
$eq = new EqualsExpression($key ,new LiteralExpression("oleg") );
$eq2 = new EqualsExpression($key,new LiteralExpression("Nastya") );

$start = new BooleanOrExpression($eq,$eq2);
	/*			
$key->interpret($text);

echo "<pre>";
var_dump ($text->lookup($key) );
echo "</pre>";*/
/*
echo "<pre>";
var_dump ($start);
echo "</pre>";
*/

foreach(array("oleg","dima","Nastya") as $val ){
	$key->setValue($val);
	//var_dump($key);
	/*echo "<pre>";
var_dump ($start);
echo "</pre>";*/
		print "$val:" ;
	$start->interpret($text);
	/*echo "<pre>";
var_dump ($text);
echo "</pre>";*/
	if($text->lookup($start) ){
		print "Соответсвует"."<br>";
	}else{
		print "Ne Соответсвует"."<br>";
	}
	/*
	echo "<pre>";
var_dump ($text);
echo "</pre>";*/
}
function boole($a,$b){
	if($a == $b){
		return true;
	}else{
		return false;
	}
}

var_dump (boole(4,4) );


?>