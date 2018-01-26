<?php 
/////////////////////ПЕРЕЧИТАТЬ!!!!!!!!!!!!!!!!!!!!!!!!!!!
abstract class Command{
	abstract function execute(CommandContext $context);
}
//(receiver)
class LoginCommand extends Command{
	function execute(CommandContext $context){
		$manager = Registry::getAccessManager();
		$user = $context->get('username');
		$pass = $context->get('pass');
		$user_obj = $manager->login($user,$pass);
		if(is_null($user_obj) ){
			$context->setError($manager->getError() );
			return false;
		}
		$context->addParam("user",$user_obj);
		return true;
	}
}

class CommandContext{
	private $params = array();
	private $error = "";
	
	function __construct(){
		$this->params = $_REQUEST;
	}
	
	function addParam($key,$val){
		$this->params[$key] = $val;
	}
	
	function get($key){
		if(isset($this->params[$key]) ){
			return $this->params[$key];
		}
		return null;
	}
	
	function serError($error){
		$this->error = $error;
	}
	
	function getError(){
		return $this->error;
	}
}

class CommandNotFounException extends Exception{}

class CommandFactory{
	private static $dir = "commands";
	
	static function getCommand($action = "Default"){
		if(preg_match('/\W/', $action)){
			throw new Exception("Недопустимые символы в команде");
		}
		$class = UCFirst(strtolower($action)) . "Command";
		$file = self::$dir. DIRECTORY_SEPARATOR . "{$class}.php";
		if(! file_exists($file) ){
			throw new Exception("Файл $file не найдет");
		}
		require_once($file);
		if (! class_exists($class) ){
			throw new Exception("Класс $class не обнаружен");
		}
		$cmd = new $class();
		return $cmd;
	}
}

class Controller{
	private $context;
	
	function __construct(){
		$this->context = new CommandContext();
	}
	function getContext(){
		return $this->context;
	}
	
	function process(){
		$action = $this->context->get('action');
		$action = (is_null($action))? "Default": $action;
		$cmd = CommandFactory::getCommand($action);
		if(! $cmd->execute($this->context) ){
			//Обработка ошики
		}
		//Все прошло упешно
		//отобразим результат
	}
}

$controller = new Controller();
//Эмулируем запрос пользователя
$context = $controller->getContext();
$context->addParam("action","login");
$context->addParam("username","bob");
$context->addParam("pass","1991");
$controller->process();





?>