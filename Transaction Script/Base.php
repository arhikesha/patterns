<?php 
namespace woo\process;
require("ApplicationRegistry.php");
abstract class Base{
	static $DB;
	static $statements = array();
	
	function __construct(){
		$dsn = \woo\process\ApplicationRegistry::getDSN();
		if( is_null($dsn) ){
			throw new Exception ("DSN не определен");
		}
		self::$DB = new \PDO($dsn,'root','password');
		self::$DB->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
	
	function prepareStatement($statement){
		if(isset(self::$statements[$statement]) ){
			return self::$statements[$statement];
		}
		$stmt_handle = self::$DB->prepare($statement);
	//	self::$statements[$statement] = $stmt_handle;
		//Пример вызова подготовки и запроса
		/*	$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($kart_players_id)  ORDER BY RAND()   LIMIT 50");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->koloda_kart = $conn->fetchAll(); */
		//echo "<pre>";
		//var_dump(self::$statements[$statement]);
		//echo "</pre>";
		return $stmt_handle;
	}
	
	public function doStatement($statement, array $values){
		$sth = $this->prepareStatement($statement);
		$sth->closeCursor();
		$db_result = $sth->execute($values);
			
		return $sth;
	}
}








?>