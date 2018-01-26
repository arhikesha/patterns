<?php 
require_once('DbConn.php');


abstract class Kart {
	protected $_db;
	
	function __construct(DbConn $db){
		return $this->_db = $db;
	}
}


class Koloda extends Kart{
	private $koloda_kart;
	private $stol_three_kart;
	private $stol_three_id;
	private $stol_two_kart;
	private $stol_two_id;
	private $stol_five_kart;
	private $stol_five_id;
	
	function setKolodaKart($kart_players_id){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($kart_players_id)  ORDER BY RAND()   LIMIT 50");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->koloda_kart = $conn->fetchAll();
	}
	
	function getKolodaKart(){
		return $this->koloda_kart;
	}
	
	function setStolKartThree($kart_players_id){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($kart_players_id)  ORDER BY RAND()   LIMIT 3");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->stol_three_kart = $conn->fetchAll();
	}
	
	function getStolKartThree(){
		return $this->stol_three_kart;
	}
	
	function setIdThree($id){
		foreach($id as $id_obj){
			$this->stol_three_id .=$id_obj['id'].",";
		}
	}
	
	function getIdThree(){
		return $this->stol_three_id;
	}
	
	function setStolKartTwo($four_kart){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($four_kart)  ORDER BY RAND()   LIMIT 1");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->stol_two_kart = $conn->fetchAll();
	}
	
	function getStolKartTwo(){
		return $this->stol_two_kart;
	}
	
	function setIdTwo($id){
		foreach($id as $id_obj){
			$this->stol_two_id .=$id_obj['id'].",";
		}
	}
	
	function getIdTwo(){
		return $this->stol_two_id;
	}
	
	function setStolKartFive($five_kart){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($five_kart)  ORDER BY RAND()   LIMIT 1");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->stol_five_kart = $conn->fetchAll();
	}
	
	function getStolKartFive(){
		return $this->stol_five_kart;
	}
	
	function setIdFive($id){
		foreach($id as $id_obj){
			$this->stol_five_id .=$id_obj['id'].",";
		}
	}
	
	function getIdFive(){
		return $this->stol_five_id;
	}
}
///////////////////////можно сделать один КЛасс . только менять входной парамент///////////////
 abstract class Players extends Kart{
}
class Player_one extends Players{
	private $karts_one = array();
	public $id_one;
	private $balance;
	
	function setKart(){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker  ORDER BY RAND()   LIMIT 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->karts_one = $conn->fetchAll();
	}
	
	function setBalance(){
		$conn = $this->_db->getDb()->prepare("SELECT score FROM balance WHERE id  = 1");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->balance = $conn->fetchAll();
	}
	
	function getBalance(){
		return $this->balance;
	}
	function saveData($player_one_balance){
			$conn = $this->_db->getDb()->prepare("UPDATE balance SET  score = '$player_one_balance' WHERE id = 1 ");
			$conn->execute();
	}
	
	function getKart(){
		return $this->karts_one;
	}
	
	function setId($id){
		foreach($id as $id_obj){
			$this->id_one .=$id_obj['id'].",";
		}
	}
	
	function getId(){
		return $this->id_one;
	}
}


class Player_two extends Players{
	private $karts_two = array();
	public $id_two;
	private $balance;
	
	function setKart ($id_one){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($id_one)  ORDER BY RAND()   LIMIT 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->karts_two = $conn->fetchAll();
	}
	
	function getKart(){
		return $this->karts_two;
	}
	
	function setBalance(){
		$conn = $this->_db->getDb()->prepare("SELECT score FROM balance WHERE id  = 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->balance = $conn->fetchAll();
	}
	
	function getBalance(){
		return $this->balance;
	}
	function saveData($player_two_balance){
			$conn = $this->_db->getDb()->prepare("UPDATE balance SET  score = '$player_two_balance' WHERE id = 2 ");
			$conn->execute();
	}
	
	function setId($id){
		foreach($id as $id_obj){
			$this->id_two .=$id_obj['id'].",";
		}
	}
	
	function getId(){
		return $this->id_two;
	}
}

class Player_three extends Players{
	private $karts_three = array();
	public $id_three;
	public $balance;
	
	function setKart ($id_one_two){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($id_one_two)  ORDER BY RAND()   LIMIT 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->karts_three = $conn->fetchAll();
	}
	
	function getKart(){
		return $this->karts_three;
	}
	
	function setBalance(){
		$conn = $this->_db->getDb()->prepare("SELECT score FROM balance WHERE id  = 3");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->balance = $conn->fetchAll();
	}
	
	function getBalance(){
		return $this->balance;
	}
	function saveData($player_three_balance){
			$conn = $this->_db->getDb()->prepare("UPDATE balance SET  score = '$player_three_balance' WHERE id = 3 ");
			$conn->execute();
	}
	
	function setId($id){
		foreach($id as $id_obj){
			$this->id_three .= $id_obj['id'].",";
		}
	}
	
	function getId(){
		return $this->id_three;
	}
}





///////////////////////////////////////////BANK/////////////////////////

class Bank{
	private $bank = 4;
	private $stavka = 10;
	private $level = 0;
	public $post_player_one;
	
	
	function getBank(){
		return $this->bank;
	}
	
	function getBet($player_one){
		$this->bank = $player_one->balance - $this->stavka;
	}
}




//$process_result->setKart($id_kart_players_one);
////
// $process_result->setQuantity();
// 
//$process_result->setType();
//
//$process_result->setSuit();
// 
//
//$process_result->AllSet();
//
//$process_result->getResult() ;
//
//$process_result->result ;
//
//
//$process_result->result_one_quantity;
//
//$process_result->result_one_quantity_two;
//
//$process_result->setOneQuantity() ;




/////////////////////////////////////////////Классы обработки результата////////////////////////////////////

class ProcessResult extends Kart{
	private $player_one_karts;
	private $player_one_quantity = array();
	private $player_one_type = array();
	private $player_one_suit = array();
	public $result_one_set_none = null;
	public $result_one_set_para = null;
	public $result_one_set_three = null;
	public $result_one_set_two_para = null;
	public $result_one_set_flesh = null;
	public $result_one_set_strid = null;
	public $result_one_set_full_house = null;
	public $result_one_set_kare = null;
	public $result_one_set_royal_flesh = null;
	public $result_one_quantity = null;
	public $result_one_quantity_two = null;
	public $result;
	
	
	function setKart($player_one_id){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id  IN($player_one_id)   LIMIT 7");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->player_one_karts = $conn->fetchAll();
	}
	
		function getKart(){
			return $this->player_one_karts;
	}
	
	function setQuantity(){
		foreach($this->player_one_karts as $player_one_kart){
			$this->player_one_quantity[] .=  $player_one_kart['quantity'];
		}
	}
	
	function getQuantity(){
		return $this->player_one_quantity;
	}
	
	function setType(){
		foreach($this->player_one_karts as $player_one_kart){
			$this->player_one_type[] .=  $player_one_kart['type'];
		}
	}
	
	function getType(){
		return $this->player_one_type;
	}
	
		
	function setSuit(){
		foreach($this->player_one_karts as $player_one_kart){
			$this->player_one_suit[] .=  $player_one_kart['suit'];
		}
	}
	
	function getSuit(){
		return $this->player_one_suit;
	}
	
	function ResultNone(){
		$arr = array();
		foreach ($this->player_one_karts  as $val){
			$arr[] = $val['quantity'];
		}
		$this->result_one_set_none = 1;
		if(!empty($arr)){
		$this->result_one_quantity  = (int)max($arr);
		}
	}	
	
	function ResultPara(){
	$arr = array_count_values($this->player_one_type);
		//var_dump($this->player_one_type);
	foreach ($arr as $key=>$val){
			$a = $val;
		if($a  === 2){
			$this->result_one_set_para = 2;
			$this->result_one_quantity  = $key;
			}
		}	
	}		
	
	function ResultTwoPara(){
	$arr = array_count_values($this->player_one_type);
	$p = 0;
	foreach ($arr as $key=>$val){
			$a = $val;
		if($a  === 2 ){
			$p++;
		}if($p === 1 && $a === 2){
			$this->result_one_quantity = $key;
		}if($p === 2 && $a === 2){
			$this->result_one_set_two_para = 3;
			$this->result_one_quantity_two  = $key;
		}if($p === 3 && $a === 2 && !$this->result == 7 ){
			$this->result_one_quantity = $this->result_one_quantity_two ;
			 $this->result_one_quantity_two = $key;
				}
			}
		}	
	
	function ResultThree(){
	$arr = array_count_values($this->player_one_type);
/* 	echo "<pre>";
	print_r($arr );
	echo "</pre>"; */
	foreach ($arr as $key=>$val){
			$a = $val;
		if($a  === 3){
			$this->result_one_set_three = 4;
			$this->result_one_quantity  = $key;
			}
		}
	}		
	///////////////////////ARRAY_SEARCH посмотреть может ли принимать несколько параменров поиска
			
	
	 function ResultFlesh(){
		 $cross = 0;$cross_quantity = 0;
		 $peak = 0;$peak_quantity = 0;
		 $chirwa = 0;$chirwa_quantity = 0;
		 $bubna = 0; $bubna_quantity = 0;
		 
	foreach ($this->player_one_karts as $key=>$val){
			$a = $val['suit'];
			$b = $val['quantity'];
	switch($a){
			case "cross";
			$cross++;
			$cross_quantity += $b;
			break;
			case "peak";
			$peak++;
			$peak_quantity += $b;
			break;
			case "chirwa";
			$chirwa++;
			$chirwa_quantity += $b;
			break;
			case "bubna";
			$bubna++;
			$bubna_quantity += $b;
			break;
	}
			if($cross >= 5){
				$this->result_one_set_flesh = 5;
				$this->result_one_quantity  =  (int)$cross_quantity ;
			}elseif($peak >= 5)	{
				$this->result_one_set_flesh = 5;
				$this->result_one_quantity  =  (int)$peak_quantity ;
			}elseif($chirwa >= 5 ){
				$this->result_one_set_flesh = 5;
				$this->result_one_quantity  =  (int)$chirwa_quantity ;
			}elseif($bubna >= 5  ){
				$this->result_one_set_flesh = 5;
				$this->result_one_quantity  =  (int)$bubna_quantity ;
			}	
		}
	}
	
		 function ResultStrid(){
			 $arr = array();
			 $arr_num = array();
	foreach ($this->player_one_karts as $key=>$val){
			 $v = $val['quantity'];
			if(!in_array($v ,$arr) ){
				$arr[] = $v ;
			}	
		}	
		if(count($arr) == 5 ){
			if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4]){
				$this->result_one_set_strid = 6;
				$this->result_one_quantity  = $arr[0] + $arr[1] + $arr[2] + $arr[3] + $arr[4];
			}
		}if(count($arr) == 6 ){
			if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5]){
				$this->result_one_set_strid = 6;
				$this->result_one_quantity  = $arr[1]+$arr[2] + $arr[3]+$arr[4]+$arr[5];
			}
		 }if(count($arr) == 7 ){
			 if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5] && $arr[5]+1 == $arr[6]){
				$this->result_one_set_strid = 6;
				$this->result_one_quantity  = $arr[2]+$arr[3] + $arr[4]+$arr[5]+$arr[6];
			}
		 }
	}
	
	///Переcмотреть !!!!
		function ResultFullHouse(){
	$arr = array_count_values($this->player_one_type);
		$fa = 0;
		$fb = 0;
	foreach ($arr as $key=>$val){
			$a = $val;
		if($a  === 2 ){
			$fa++;
			$this->result_one_quantity_two  = $key;
		}if($a === 3){
			$fb++;
		}if($fb === 1 && $a === 3){
				$this->result_one_quantity  = $key;
		}if(($fb >= 1 && $fa >= 1)  )  {
			$this->result_one_set_full_house = 7;
				}
		}	
	}		
	
		function ResultKare(){
	$arr = array_count_values($this->player_one_type);
	foreach ($arr as $key=>$val){
			$a = $val;
		if($a  === 4){
			$this->result_one_set_kare = 8;
			$this->result_one_quantity  = $key;
			}
		}	
	}
	///////////////////////////////////////////////////////
	function ResultRoyalFlesh(){
		 $cross = 0;$cross_quantity = array();
		 $peak = 0;$peak_quantity = array();
		 $chirwa = 0;$chirwa_quantity = array();
		 $bubna = 0; $bubna_quantity = array();
		 
	foreach ($this->player_one_karts as $key=>$val){
			$a = $val['suit'];
			$b = $val['quantity'];
	switch($a){
			case "cross";
			$cross++;
			$cross_quantity[] = $b;
			break;
			case "peak";
			$peak++;
			$peak_quantity[] = $b;
			break;
			case "chirwa";
			$chirwa++;
			$chirwa_quantity[] = $b;
			break;
			case "bubna";
			$bubna++;
			$bubna_quantity[] = $b;
			break;
		}
	}
			if($cross >= 5){
				$arr = array();
				foreach ($cross_quantity as $val){
			 $v = $val;
				if(!in_array($v ,$arr) ){
					$arr[] = $v ;
			}
		}	
			if(count($arr) == 5 ){
					if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4]){
				$this->result_one_set_royal_flesh = 9;
					$this->result_one_quantity  = $arr[0] + $arr[1] + $arr[2] + $arr[3] + $arr[4];
				}
			}if(count($arr) == 6 ){
			if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[1] + $arr[2] + $arr[3] + $arr[4] + $arr[5];
			}
		 }if(count($arr) >= 7 ){
				if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5] && $arr[5]+1 == $arr[6]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[2]+$arr[3] + $arr[4]+$arr[5]+$arr[6];
			}
		 }

			}elseif($peak >= 5)	{
				$arr = array();
				foreach ($peak_quantity as $val){
			 $v = $val;
				if(!in_array($v ,$arr) ){
					$arr[] = $v ;
			}
		}	
				if(count($arr) == 5 ){
					if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4]){
				$this->result_one_set_royal_flesh = 9;
					$this->result_one_quantity  = $arr[0] + $arr[1] + $arr[2] + $arr[3] + $arr[4];
				}
			}if(count($arr) == 6 ){
			if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[1] + $arr[2] + $arr[3] + $arr[4] + $arr[5];
			}
		 }if(count($arr) >= 7 ){
				if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5] && $arr[5]+1 == $arr[6]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[2]+$arr[3] + $arr[4]+$arr[5]+$arr[6];
			}
		 }

			}elseif($chirwa >= 5 ){
				$arr = array();
				foreach ($chirwa_quantity as $val){
			 $v = $val;
				if(!in_array($v ,$arr) ){
					$arr[] = $v ;
			}
		}	
		if(count($arr) == 5 ){
					if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4]){
				$this->result_one_set_royal_flesh = 9;
					$this->result_one_quantity  = $arr[0] + $arr[1] + $arr[2] + $arr[3] + $arr[4];
				}
			}if(count($arr) == 6 ){
			if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[1] + $arr[2] + $arr[3] + $arr[4] + $arr[5];
			}
		 }if(count($arr) >= 7 ){
				if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5] && $arr[5]+1 == $arr[6]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[2]+$arr[3] + $arr[4]+$arr[5]+$arr[6];
			}
		 }
			}elseif($bubna >= 5  ){
				$arr = array();
				foreach ($bubna_quantity as $val){
			 $v = $val;
				if(!in_array($v ,$arr) ){
					$arr[] = $v ;
			}
		}	
		if(count($arr) == 5 ){
					if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4]){
				$this->result_one_set_royal_flesh = 9;
					$this->result_one_quantity  = $arr[0] + $arr[1] + $arr[2] + $arr[3] + $arr[4];
				}
			}if(count($arr) == 6 ){
			if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[1] + $arr[2] + $arr[3] + $arr[4] + $arr[5];
			}
		 }if(count($arr) >= 7 ){
				if($arr[0]+1 == $arr[1] && $arr[1]+1 == $arr[2] && $arr[2]+1 == $arr[3] && $arr[3]+1 == $arr[4] && $arr[4]+1 == $arr[5] && $arr[5]+1 == $arr[6]){
				$this->result_one_set_strid = 9;
				$this->result_one_quantity  = $arr[2]+$arr[3] + $arr[4]+$arr[5]+$arr[6];
			}
		 }
			}	
	}
	
	
	function AllSet(){
		$this->ResultNone();
		$this->ResultPara();
		$this->ResultTwoPara();
		$this->ResultThree();
		$this->ResultStrid();
		$this->ResultFlesh();	
		$this->ResultFullHouse();
		$this->ResultKare();
		$this->ResultRoyalFlesh();
	}

	function getResult(){
	$this->result = max ($this->result_one_set_none,$this->result_one_set_para,$this->result_one_set_two_para,
											$this->result_one_set_three ,$this->result_one_set_strid,
									   	$this->result_one_set_flesh	,$this->result_one_set_full_house,
											$this->result_one_set_kare,$this->result_one_set_royal_flesh ) ;
		return 	$this->result;
	}
	
	function setOneQuantity(){
		if($this->result !=1 && $this->result != 5 && $this->result != 6 && $this->result !=9 ){
		$type = array_column($this->player_one_karts,"type","quantity" );
		$type  = array_search($this->result_one_quantity,$type);
		$this->result_one_quantity = $type ;
		}
		//SWITCH
		if($this->result == 1){
			//без сета
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two = 0;
		}elseif($this->result == 2){
			//пара
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two = 0;
		}elseif($this->result == 3){
				//две пара
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two *= 1;
		}elseif($this->result == 4){
					//трио
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two = 0;
		}elseif($this->result == 5){
				//флеш
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two = 0;
		}elseif($this->result == 6){
				//стрид
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two = 0;
		}elseif($this->result == 7){
				//фулхаус
		$this->result_one_quantity *= 5;
		$this->result_one_quantity_two *= 1;
		}elseif($this->result == 8){
				//каре
		$this->result_one_quantity *= 4;
		$this->result_one_quantity_two = 0;
		}elseif($this->result == 9){
				//фулстрид
		$this->result_one_quantity *= 5;
		$this->result_one_quantity_two = 0;
		}else{
			$this->result_one_quantity = 0;
		}
		return 	$this->result_one_quantity;
	}
}


/////////////////Попробывать результат и второе значение через мессив

////////////////////////////////////Класс победителя/////////////////////////////////,ProcessResult $player_three

class PlayerWins{
	public $coun = 0;
	public $countes = 6;
	
	
	function Wins(ProcessResult $player_one,ProcessResult $player_two,ProcessResult $player_three){
	
		if($player_one->result > $player_two->result && $player_one->result > $player_three->result){
			echo "Победил первый игрок c результатом $player_one->result"."  ";
						$this->coun = 1;
		}if($player_two->result > $player_one->result && $player_two->result > $player_three->result){
				echo "Победил второй игрок c результатом $player_two->result"."  ";
						$this->coun = 2;
		}if($player_three->result > $player_one->result && $player_three->result > $player_two->result){
				echo "Победил третий игрок c результатом $player_three->result"."  ";
						$this->coun = 3;
		}
			if($this->coun === 0){
		if($player_one->result == $player_two->result > $player_three->result ){
					if($player_one->result_one_quantity >$player_two->result_one_quantity){
							echo "Равны Победил первый игрок c результатом $player_one->result_one_quantity";
					}if($player_two->result_one_quantity >$player_one->result_one_quantity){
							echo "Равны Победил второй игрок c результатом $player_two->result_one_quantity";
					}if($player_two->result_one_quantity == $player_one->result_one_quantity){
						echo "Ничья первый === второй ";
					}				
			}
		if($player_one->result == $player_three->result > $player_two->result ){
			if($player_one->result_one_quantity >$player_three->result_one_quantity){
							echo "Равны Победил первый игрок c результатом $player_one->result_one_quantity";
					}if($player_one->result_one_quantity < $player_three->result_one_quantity){
							echo "Равны Победил третий игрок c результатом $player_three->result_one_quantity";
					}if($player_one->result_one_quantity == $player_three->result_one_quantity){
						echo "Ничья  первый === третьему";
					}		
		}
		if($player_two->result == $player_three->result > $player_one->result ){
				if($player_two->result_one_quantity >$player_three->result_one_quantity){
							echo "Равны Победил второй игрок c результатом $player_two->result_one_quantity";
					}if($player_two->result_one_quantity < $player_three->result_one_quantity){
							echo "Равны Победил третий игрок c результатом $player_three->result_one_quantity";
					}if($player_two->result_one_quantity == $player_three->result_one_quantity){
						echo "Ничья  второй === третьему";
					}		
				}
				///////Всe равны
		if($player_one->result == $player_two->result && $player_one->result == $player_three->result && $player_three->result == $player_two->result){
			if($player_one->result_one_quantity > $player_two->result_one_quantity && $player_one->result_one_quantity >$player_three->result_one_quantity ){
				echo "Все равны   первый победил";
					$this->countes = 1;
			}if($player_two->result_one_quantity >$player_one->result_one_quantity && $player_two->result_one_quantity >$player_three->result_one_quantity ){
				echo "Все равны   второй победил";
					$this->countes = 2;
			}if($player_three->result_one_quantity >$player_two->result_one_quantity && $player_three->result_one_quantity >$player_one->result_one_quantity ){
				echo "Все равны   третий победил";
					$this->countes = 3;
			}
				if($player_one->result_one_quantity == $player_two->result_one_quantity && $player_two->result_one_quantity == $player_three->result_one_quantity ){
						echo "ТРОЙная полная ничья";
						$this->countes = 4;
					}
							 ///////////////ПРоерять на равенство пары и фулхаус, Добавить дополнительное свойство
				 	if($this->countes = 6){ 		
			if($player_one->result_one_quantity == $player_two->result_one_quantity > $player_three->result_one_quantity ){
				if($player_one->result_one_quantity == $player_two->result_one_quantity){
					echo "Равны Два последних значения $player_one->result_one_quantity и  $player_two->result_one_quantity  НИЧЬЯ ";
					}		
			}if($player_one->result_one_quantity == $player_three->result_one_quantity > $player_two->result_one_quantity ){
				if($player_one->result_one_quantity == $player_three->result_one_quantity){
					echo "Равны Два последних значения $player_one->result_one_quantity и  $player_three->result_one_quantity  НИЧЬЯ ";
					}
			}if($player_two->result_one_quantity == $player_three->result_one_quantity > $player_one->result_one_quantity ){
				if($player_two->result_one_quantity == $player_three->result_one_quantity){
					echo "Равны Два последних значения $player_two->result_one_quantity и  $player_three->result_one_quantity  НИЧЬЯ ";							
					}
							}				
						} 
					}
				}	
			}
		}




?>