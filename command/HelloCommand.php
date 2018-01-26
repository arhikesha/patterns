<?php 
//namespace book\command;

include ('CommandInterface.php');

class HelloCommand implements CommandInterface{
	private $output;
	
	public function __construct(Receiver $console){
		$this->output = $console;
	}
	
	public function execute(){
		$this->output->write('Hello World');
	}
}









?>