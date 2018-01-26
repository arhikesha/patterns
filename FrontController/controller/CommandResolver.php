<?php 
namespace woo\command;
include("Command.php");
include("DefaultCommand.php");

class CommandResolver{
	private static $base_cmd = null;
	private static $default_cmd = null;
	/////////////////////////СОЗДАТЬ НОВУЮ КОМАНДУ (ЧТОБЫ не new DefaultCommand() дефолтную)
	function __construct(){
		if(is_null(self::$base_cmd) ){
			var_dump	(self::$base_cmd = new \ReflectionClass("\woo\command\Command") );
		var_dump	(self::$default_cmd = new DefaultCommand() );
		}
	}
	
	function getCommand(\woo\controller\Request $request){
			var_dump ($cmd = $request->getProperty('cmd') );
		$sep = DIRECTORY_SEPARATOR;
		
		if(! $cmd){
			return self::$default_cmd;
		}
	
	$cmd = str_replace(array('.',$sep),"",$cmd);
	$filepath = "controller{$sep}{$cmd}.php" ;
	$classname = "\woo\\command\\$cmd";
	
	if(file_exists($filepath) ){
		require_once($filepath);
			if(class_exists($classname) ){
				$cmd_class = new \ReflectionClass($classname);
					if($cmd_class->isSubClassOf(self::$base_cmd) ){
						return $cmd_class->newInstance();
					}else{
						$request->addFeedback("Обьект Command команды '$cmd' не найден");
					}
			}
		}else{
			echo "НЕ верный путь к файлу";
		}
		$request->addFeedback("Команда '$cmd' не найдена");
		return clone self::$default_cmd;
	}
}




?>