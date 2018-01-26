<?php 
namespace woo\process;
require("Base.php");

class VenueManager extends  Base{
	static $add_venue = "INSERT INTO venue
												(name)
												values( ? )";
	static $add_space = "INSERT INTO space
												(name,venue)
												values( ?, ?)";
	static $chec_slot = "SELECT id,name
												FROM event
												WHERE space = ?
												AND (start+duration) > ?
												AND start < ?";
	static $add_event = "INSERT INTO event
												(name, space, start, duration)
												values( ?, ?, ?, ?)";
												
	function addVenue($name,$space_array){
		$venuedata = array();
		$venuedata['venue'] = array($name);
		$this->doStatement(self::$add_venue,$venuedata['venue']);
		$v_id = self::$DB->lastInsertId();
		$venuedata['spaces'] = array();
		foreach($space_array as $space_name){
			$values = array($space_name, $v_id);
			//var_dump($values);
			$this->doStatement(self::$add_space, $values);
			$s_id = self::$DB->lastInsertId();
			array_unshift($values, $s_id);
			$venuedata['spaces'][] = $values;
			echo "<pre>";
			var_dump($venuedata);
			echo "</pre>";
		}
		return $venuedata;
	}											
	
	function bookEvent($space_id, $name, $time, $duration){
		$values = array($space_id,$time, ($time+$duration) );
		$stmt = $this->doStatement(self::$chec_slot,$values, false);
		if($result = $stmt->fetch() ){
			throw new \Exception(" Уже зарегестрировано попробуйте еще раз");
		}
		$this->doStatement(self::$add_event,array($name,$space_id,$time,$duration) );
		
		
	}
}


$query = new VenueManager();
$query->addVenue("Днепр",array(1,2) );

//$query->bookEvent(41,'Lucia',1900,45);



?>