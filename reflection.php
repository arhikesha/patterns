<?php
class ShopProduct{
private $title;
private $producerMainName ;
private $producerFirstName ;
protected $price;
private $discount = 0 ;
	
	public function __construct($title,$mainName,$firsName,$price){
		$this->title = $title;
		$this->producerMainName = $mainName;
		$this->producerFirstName = $firsName;
		$this->price = $price;
	}
	public function getProducerMainName(){
		return $this->producerMainName;
	}
	public function getProducerFirstName(){
		return $this->producerFirstName;
	}
	public function setDiscount ( $num ) {
		$this->discount=$num;
	}
	public function getDiscont(){
		return $this->discount;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getPrice(){
		return ($this->price - $this->discount);
	}
	
	public function getProducer(){
		return "{$this->producerFirstName} ".
	"{$this->producerMainName}";
	}
	public function sumaryLine(){
		$base = "{$this->title} ( {$this->producerFirstName}";
		$base.= "{$this->producerMainName})";
		return $base;
	}
}

	class CDProduct extends ShopProduct{
		public $lenghtCD ;
		
		public function __construct($title,$mainName,$firsName,$price,$playLength = null){
		
		parent::__construct ($title,$mainName,$firsName,$price);
			return $this->playLength = $playLength;
		}
		public function getPleyLength(){
			return $this->playLength;
		}
		public function sumaryLine(){
				$base = parent::sumaryLine();
				$base .= ":Время звучания - {$this->playLength}";
				return $base;
		}
	}
	
	class BookPage extends ShopProduct{
			private $nubPages ;
			
			public function __construct($title,$mainName,$firsName,$price,$nubPages = null){
			
		  parent::__construct ($title,$mainName,$firsName,$price);
			return $this->nubPages = $nubPages;
		}
		public function getBookPage(){
			return $this->nubPages;
		}
			public function sumaryLine(){
					$base = parent::sumaryLine();
					$base .= "{$this->nubPages} стр.";
					return $base;
		}

	}

class ShopProductWriter{
	private $product = array();
	
	public function addProduct(ShopProduct $shopProduct){
		$this->products[] = $shopProduct;
	}
	
	public function write(){
		$str = "";
		
		foreach ($this->products as $shopProduct){	
		$str = $shopProduct->sumaryLine() .  " {$shopProduct->getPrice()}";
		}
		print $str;
	}
}
$write = new ShopProductWriter();
$product2 = new CDProduct(" Пропавший без вести " ,"Группа " , "ДДТ " ,134,10.99 );
$product2->setDiscount(34);

$write->addProduct($product2);
$write->write($product2);

$product3 = new BookPage("Собачье сердце","Михаил","Булгаков",42,153);

echo "<br>";
$write->addProduct($product3);
$write->write($product3);

echo "<br>";
$product4 = new CDProduct("Охотник " ," Группа" , "Король и щут " ,421,10.99 );
//$product4->setDiscount(21);
call_user_func(array($product4,'setDiscount'),22);//динамически вызвани ,эквивалентно $product4->setDiscount(21)

$write->addProduct($product4);
$write->write($product4);
echo "<br>";
if(get_class($product4) == "CDProduct"){
	print "\$product4 - Обьек класса  CDProduct\n";
}
echo "<br>";
if($product4 instanceof ShopProduct ){
	print "\$product4 - Обьек типа  ShopProduct\n";
}
/*
echo "<br>";
echo "<pre>";
var_dump($write);
echo "</pre>";
*/
echo "<pre>";
print_r (get_class_methods('CDProduct')) ;
echo "</pre>";

///////
$method = "getTitle";
print $product4->$method();

/////Проверка на существованиее метода
if(in_array($method,get_class_methods($product4))){
	print $product4->$method();
}
/////Можно вместо обьекта $product4 сам  класс  например'CDProduct'
if(is_callable(array($product4,$method))){
	print $product4->$method();
}
///////////Проверка на существованиее метода 3 способ
if(method_exists($product4,'getTitle')){
		print $product4->$method();
}
//ПРоверка на свойства
echo "<br>";
var_dump (get_class_vars('CDProduct'));
//Проверка на наследование 
echo "<br>";
print_r (get_parent_class("CDProduct"));
//////
echo "<br>";
if(is_subclass_of($product4,'ShopProduct')){
	print "CDProduct является подкласов ShopProduct";
}

//Проверка на интерфейс
if(in_array('nameInterface',class_implements($product4))){
		print "CDProduct использует интерфейс nameInterface";
}
/////Вызов метода



/////////////////////////////////////REFLECTION///////////////////////////////////

$prod_class = new ReflectionClass('BookPage');
echo "<pre>";
Reflection::export($prod_class);
echo "</pre>";

echo "<br>";



//Иследование класса///

function classData( ReflectionClass $class ){
$details = "";
$name = $class->getName() ;
if ($class->isUserDefined() ) {
$details.= "$name -- класс определен пользователем\n " ;
}
if($class->isInternal() ){
	$details.= "$name -- Встроенный класс \n " ;
}
if($class->isInterface()){
		$details.= "$name --Это интерфейс \n " ;
}
if($class->isAbstract()){
		$details.= "$name -- Абстрактный класс \n " ;
}
if($class->isFinal()){
	$details.= "$name -- это завершенный класс \n " ;
}
if($class->isInstantiable() ){
	$details.= "$name -- можно создать экземпляр  класс \n " ;
}else{
		$details.= "$name -- нельзя создать экземпляр  класс \n " ;
}
if($class->isCloneable()){
	$details.= "$name -- можно клонировать \n " ;
}else{
		$details.= "$name -- нельзя клонировать \n " ;
}
return $details;
}

$prod_class2 = new ReflectionClass('BookPage');

echo "<pre>";
print classData($prod_class2);
echo "</pre>";


////////Доступ к исходному коду

class ReflectionUtil{
	static function getClassSource(ReflectionClass $class){
		$path = $class->getFileName();
		$lines = @file($path);
		$from = $class->getStartLine();
		$to = $class->getEndLine();
		$len = $to - $from +1;
		return implode(array_slice($lines,$from-1,$len));
	}
}
echo "<pre>";
print ReflectionUtil::getClassSource(new ReflectionClass ('ShopProduct'));
echo "</pre>";




//Иследование Методов////////////////////////////////////////

$prod_method = new ReflectionClass ('CDProduct');
$methods = $prod_method->getMethods();

foreach($methods as $method){
	echo "<pre>";
	print methodData($method) ;
	echo "</pre>";
}
function methodData (ReflectionMethod $method){
	$details = "";
	$name = $method->getName() ;
	if ($method->isUserDefined() ) {
	$details.= "$method -- метод определен пользователем\n " ;
}
if($method->isInternal() ){
	$details.= "$method -- Внутрений метод \n " ;
}
if($method->isAbstract()){
		$details.= "$method -- Абстрактный метод \n " ;
}
if($method->isPublic()){
		$details.= "$method -- Публичный метод \n " ;
}
if($method->isProtected()){
		$details.= "$method -- защищенный  метод \n " ;
}
if($method->isPrivate()){
		$details.= "$method -- закрытый  метод \n " ;
}
if($method->isStatic()){
		$details.= "$method -- статический  метод \n " ;
}
if($method->isFinal()){
		$details.= "$method -- финальный  метод \n " ;
}
if($method->isConstructor()){
		$details.= "$method -- метод конструкторa   \n " ;
}
if($method->returnsReference()){
		$details.= "$method -- Метод возвращает ссылку , а не значение  \n " ;
}
return $details;
}

////////Доступ к исходному коду
class ReflectionUtilMethod{
	static function getMethodSource(ReflectionMethod $method){
		$path = $method->getFileName();
		$lines = @file($path);
		$from = $method->getStartLine();
		$to = $method->getEndLine();
		$len = $to - $from +1;
		return implode(array_slice($lines,$from-1,$len));
	}
}
echo "<br>";
$clas = new ReflectionClass('CDProduct');
$method =  $clas->getMethod('__construct');

	echo "<pre>";
print ReflectionUtilMethod::getMethodSource($method);
	echo "</pre>";


////////////////Иследование Аргументов Метода/////////////////////////

$prod_classMethod = new ReflectionClass ('CDProduct');
$methodParams = $prod_classMethod->getMethod('__construct');
$params = $methodParams->getParameters();

foreach ($params as $param){
	echo "<pre>";
	print argData($param);
		echo "</pre>";
}



function argData(ReflectionParameter $arg){
	$details = "";
	$declarinclass = $arg->getDeclaringClass();
	$name = $arg->getName();
	$class = $arg->getClass();
	$position = $arg->getPosition();
	$details .="\$$name находится на позиции $position\n";
	if ( !empty ($class) ) {
	$classname = $class->getName() ;
	$details .= "\$$name должен Сiыть объектом типа $classname\n " ;
}
		if ( $arg->isPassedByReference () ){
	$details.= "\$$name передан по ссылке\n ";
}
	if ( $arg->isDefaultValueAvailable ()) {
$def = $arg->getDefaultValue() ;
$details.= "\$$name по умолчанию равно : $def\n " ;
}
return $details;
}




?>