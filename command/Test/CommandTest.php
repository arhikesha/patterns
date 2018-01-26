<?php 
//namespace book\command\Test;

include ('../HelloCommand.php');
//use book\command\HelloCommand;
include ('../Receiver.php');
//use book\command\Receiver;
include ('../Invoker.php');
//use book\command\Invoker;
//use PHPUnit\Framework\TestCase;
class CommandTest{
	public function testInvocation(){
		$invoker = new Invoker();
		$receiver = new Receiver();
		
		$invoker->setCommand(new HelloCommand($receiver) );
		$invoker->run();
		//$this->assertEquals('Hello World', $receiver->getOutput() );
		$receiver->getOutput();
	}
}

$cmd = new CommandTest();
$cmd->testInvocation();
?>