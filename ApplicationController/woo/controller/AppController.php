<?php 
namespace AppController\woo\controller;

class AppController{
	private static $base_cmd = null;
	private static $default_cmd = null;
	private $controllerMap;
	private $invoked = array();
	
	function __construct(ControllerMap $map){
		$this->controllerMap = $map;
		if(is_null(self::$base_cmd) ){
			self::$base_cmd = new \ReflectionClass("\AppController\woo\command");
			self::$default_cmd = new \AppController\woo\DefaultCommand();
		}
	}
	
	function reset(){
		$this->invoker = array();
	}
	
	function getView(Request $req){
		$view = $this->getResource($req,"View");
		return $view;
	}
	
	private function getForward(Request $req){
		$forward = $this->getResource($req,"Forward");
		if($forward){
			$req->setProperty('cmd', $forward);
		}
		return $forward;
	}
	
	private function getResource(Request $req, $res){
		//Определим предыдущую команду и ее код состояния
		$cmd_str = $req->getProperty('cmd');
		$previous = $req->getLastCommand();
		$status = $previous->getStatus();
			
			if( !isset( $status) || !is_int($status) ){$status = 0;}
			$acquire = "get$res";
			$resource = $this->controllerMap->$acquire($cmd_str, $status);
			///определим альтернативный ресурс для команды и кода состояния 0
			if(is_null($resource) ){
				$resource = $this->controllerMap->$acquire($cmd_str, 0);
			}
			
			//Либо для команды 'default' и текущего кода состоянния
			if(is_null ($resource) ){
				$resource = $this->controllerMap->$acquire('default', $status);
			}
	
	//Если ничего не найдено , определим ресурс для команды 'default' и кода состояния 0
			if(is_null($resource) ){
				$resource = $this->controllerMap->$acquire('default', 0);
				}
				return $resource;
	}
	
	function getCommand(Request $req){
		$previous = $req->getLastCommand();
		
		if(!$previous){
			//Это ервая команда текущего запроса
			$cmd = $req->getProperty('cmd');
			if(is_null( $cmd) ){
				// параметр 'cmd' не определен, используем 'default'
				$req->setProperty('cmd', 'default');
				return self::$default_cmd;
			}
		}else{
			//Команда уже запущена в текущем запросе
			$cmd = $this->getForward($req);
			if(is_null ($cmd) ){ return null ;}
		}
		//Здесь в переменно $cmd находится имя команды
		//Преобразуем его в обьект типа Command
		$cmd_obj = $this->resolveCommand($cmd);
		if(is_null ($cmd_obj) ){
			throw new AppException("Команда '$cmd' не найдена");
		}
		$cmd_class =get_class ( $cmd_obj);
		if( isset ($this->invoked[$cmd_class]) ){
			throw new AppException("Цилический вызов");
		}
		$this->invoked[$cmd_class] = 1;
		//Возвращаем обьект типа Command
		return $cmd_obj;
	}
	
	function resolveCommand($cmd){
		$class_root = $this->controllerMap->getClassroot($cmd);
		$filepath = "command/$classroot.php";
		$classname = "\AppController\woo\$classroot";
		if(file_exists($filepath) ){
			require_once("$filepath");
				if(class_exists( $classname) ){
					$cmd_class = new ReflectionClass ($classname);
						if($cmd_class->isSubClassOf(self::$base_cmd) ){
							return $cmd_class->newInstatce();
						}
				}
		}
		return null;
	}
	
	
	
	
	
	
	
	
	
	
	
}







?>