<?php 
require_once('DbConn.php');

abstract class Kart {
	public $_db;
	
	function __construct(DbConn $db){
		return $this->_db = $db;
	}
}

///////////////////////можно сделать один запрос . только менять входной парамент///////////////
 abstract class Players extends Kart{
}

class Koloda extends Kart{
	private $koloda_kart;
	private $stol_three_kart;
	private $stol_three_id;
	private $stol_two_kart;
	private $stol_two_id;
	
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
	
	function setStolKartTwo($last_kart){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($last_kart)  ORDER BY RAND()   LIMIT 2");
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
}



class Player_one extends Players{
	private $karts_one = array();
	public $id_one;
	
	function setKart(){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker  ORDER BY RAND()   LIMIT 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->karts_one = $conn->fetchAll();
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
	
	function setKart ($id_one){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($id_one)  ORDER BY RAND()   LIMIT 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->karts_two = $conn->fetchAll();
	}
	
	function getKart(){
		return $this->karts_two;
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
	
	function setKart ($id_one_two){
		$conn = $this->_db->getDb()->prepare("SELECT * FROM poker WHERE id NOT IN($id_one_two)  ORDER BY RAND()   LIMIT 2");
		$conn->execute();
		$conn->setFetchMode(PDO::FETCH_ASSOC);
		$this->karts_three = $conn->fetchAll();
	}
	
	function getKart(){
		return $this->karts_three;
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
		$this->result_one_quantity  = (int)max($arr);
		///ДОДЕЛАТЬ ОТ ПЕРВОГО МАХ ОТНЯТЬ и присвоить второму
		//$arr_none = array();
		//$arr_none = $arr;
		//$this->result_one_quantity_two =(int)max($arr_none[5]) ;
		//var_dump($arr_none);
	}	
	
	function ResultPara(){
		$arr_para = array();
	$arr = array_count_values($this->player_one_type);
		//var_dump($this->player_one_type);
	foreach ($arr as $key=>$val){
			$a = $val;
		if($a  === 2){
			foreach ($this->player_one_karts as $val){
				$arr_para[] = $val['quantity'];
			}
			/*echo "<pre>";
			var_dump($arr_para);
			echo "</pre>";*/
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
	/*	echo "<pre>";
		var_dump($arr);
		var_dump($arr_num);
		echo "</pre>";*/
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
		echo "Значение дополнительных очков ".$this->result_one_quantity."<br>";
	}
	
	///Переcмотреть !!!!
		function ResultFullHouse(){
	$arr = array_count_values($this->player_one_type);
		//var_dump($this->player_one_type);
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
		//var_dump($this->player_one_type);
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
		
		
		
		echo "<pre>";
			var_dump ($arr);
			echo "</pre>";
			
			
				
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
		
		
		
		echo "<pre>";
			var_dump ($arr);
			echo "</pre>";
			
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
		
		
		
		echo "<pre>";
			var_dump ($arr);
			echo "</pre>";
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
		
		
		
		echo "<pre>";
			var_dump ($arr);
			echo "</pre>";
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
		}elseif($this->result == 2){
			//пара
		$this->result_one_quantity *= 1;
		}elseif($this->result == 3){
				//две пара
		$this->result_one_quantity *= 1;
		$this->result_one_quantity_two *= 1;
		}elseif($this->result == 4){
					//трио
		$this->result_one_quantity *= 1;
		}elseif($this->result == 5){
				//флеш
		$this->result_one_quantity *= 1;
		}elseif($this->result == 6){
				//стрид
		$this->result_one_quantity *= 1;
		}elseif($this->result == 7){
				//фулхаус
		$this->result_one_quantity *= 5;
		$this->result_one_quantity_two *= 1;
		}elseif($this->result == 8){
				//каре
		$this->result_one_quantity *= 4;
		}elseif($this->result == 9){
				//фулстрид
		$this->result_one_quantity *= 5;
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







































////////////////////////1/////////////////////
$player_one = new Player_one(DbConn::getInstance() );
$player_one->setKart();
foreach ($player_one->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
$player_one->setId($player_one->getKart() );
$id_one = $player_one->getId();
$id_one = rtrim($id_one,",");
//var_dump ($player_one->getId() );

////////////////////////2/////////////////////
$player_two = new Player_two(DbConn::getInstance() );
$player_two->setKart($id_one);
foreach ($player_two->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
$player_two->setId($player_two->getKart() );
$id_two = $player_two->getId();
$id_one_two = $id_one.",".$player_two->getId();
$id_one_two = rtrim($id_one_two,",");
//var_dump($id_one_two);


////////////////////////3/////////////////////
$player_three= new Player_three(DbConn::getInstance() );
$player_three->setKart($id_one_two);
foreach ($player_three->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
$player_three->setId($player_three->getKart() );
$id_three = $player_three->getId();
$id_one_two_three = $id_one.",".$player_two->getId().$player_three->getId();
$id_one_two_three = rtrim($id_one_two_three,",");
 echo "Карты Трех игроков "; var_dump($id_one_two_three );


$koloda = new Koloda(DbConn::getInstance() );
$koloda->setKolodaKart($id_one_two_three);

$koloda->setStolKartThree($id_one_two_three);
$koloda->setIdThree($koloda->getStolKartThree() );

$last_kart = $id_one_two_three.",".$koloda->getIdThree();
$last_kart = rtrim($last_kart,",");

$koloda->setStolKartTwo($last_kart);
$koloda->setIdTwo($koloda->getStolKartTwo() );

//Все карты для незвестных двух на стол
/*echo "<pre><h3>";
var_dump ($last_kart );
echo "</h3></pre>"; */ 
/*
 echo "<pre>";
var_dump ($koloda->getStolKartTwo() );
echo "</pre>"; 
*/
$all_stol_kart = $koloda->getIdThree().$koloda->getIdTwo();

$id_kart_players_one = $id_one;
$id_kart_players_one .=",". $all_stol_kart;
$id_kart_players_one = rtrim($id_kart_players_one,",");

 echo "<pre>";
 echo "Карты первого игрока вместе с колодой";
var_dump ($id_kart_players_one );
echo "</pre>"; 



$id_kart_players_two = $id_two;
$id_kart_players_two .= $all_stol_kart;
$id_kart_players_two = rtrim($id_kart_players_two,",");

 echo "<pre>";
 echo "Карты второго игрока вместе с колодой";
var_dump ($id_kart_players_two );
echo "</pre>"; 

$id_kart_players_three = $id_three;
$id_kart_players_three .= $all_stol_kart;
$id_kart_players_three = rtrim($id_kart_players_three,",");

 echo "<pre>";
 echo "Карты Третьего игрока вместе с колодой";
var_dump ($id_kart_players_three );
echo "</pre>"; 



$process_result = new ProcessResult(DbConn::getInstance() );
$process_result->setKart($id_kart_players_one);
 $process_result->setQuantity();
$process_result->setType();
$process_result->setSuit();
 
/*  echo "<pre>";
var_dump ($process_result->getQuantity() );
var_dump ($process_result->getType() );
var_dump ($process_result->getSuit() );
echo "</pre>"; 
 */
$process_result->AllSet();
$process_result->getResult() ;
echo "<h2>Код результата ";
var_dump ($process_result->result) ;
echo "</h2>";

var_dump ($process_result->result_one_quantity);
echo "ВТОРОЕ ЗНАЧЕНИЕ";
var_dump ($process_result->result_one_quantity_two);
echo "<h1>Значение ";
var_dump ($process_result->setOneQuantity() );
echo "</h1>";
/*  echo "<pre>";
var_dump($process_result);
echo "</pre>"; */
foreach ($process_result->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}


$process_result2 = new ProcessResult(DbConn::getInstance() ) ;
$process_result2->setKart($id_kart_players_two)  ;
$process_result2->setQuantity();
$process_result2->setType();
$process_result2->setSuit();
/*  echo "<pre>";
var_dump ($process_result2->getQuantity() );
var_dump ($process_result2->getType() );
var_dump ($process_result2->getSuit() );
echo "</pre>"; 
 */
$process_result2->AllSet();
var_dump ($process_result2->getResult() );
echo "<h2>Код результата ";
var_dump ($process_result2->result );
echo "</h2>";
var_dump ($process_result2->result_one_quantity);
echo "ВТОРОЕ ЗНАЧЕНИЕ";
var_dump ($process_result2->result_one_quantity_two);


echo "<h1>Значение ";
var_dump ($process_result2->setOneQuantity() );
echo "</h1>";

foreach ($process_result2->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}



$process_result3 = new ProcessResult(DbConn::getInstance() ) ;
$process_result3->setKart($id_kart_players_three)  ;
$process_result3->setQuantity();
$process_result3->setType();
$process_result3->setSuit();
/*  echo "<pre>";
var_dump ($process_result3->getQuantity() );
var_dump ($process_result3->getType() );
var_dump ($process_result3->getSuit() );
echo "</pre> ";*/

 $process_result3->AllSet();
var_dump ($process_result3->getResult() );
echo "<h2>Код результата ";
var_dump ($process_result3->result );
echo "</h2>"; 

var_dump ($process_result3->result_one_quantity);
echo "ВТОРОЕ ЗНАЧЕНИЕ";
var_dump ($process_result3->result_one_quantity_two);



echo "<h1>Значение ";
var_dump ($process_result3->setOneQuantity() );
echo "</h1>";

foreach ($process_result3->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}


$wins = new PlayerWins();
 echo "<pre>";
 $wins->wins($process_result,$process_result2,$process_result3) ;
echo "</pre>"; 

 
 
 
 echo $wins->coun;








/////////////////////////МАССИВ////////////////////////////
/*
$arr = [1=>[1=>32,
						2=>365,
						3=>332,
						],
		];
	$ol = array();
$ol = $arr[1][3];	
echo "<pre>";
var_dump ($ol );
echo "</pre>"; */
/////////////Сортировка/////////////////////////


/* 
sort($a);
 echo "<pre>";
var_dump ($a );
echo "</pre>"; 
*/

/*
$a = array_count_values($a);
 echo "<pre>";
var_dump ($a);
echo "</pre>"; 
$c = "";
$k = "";
	$para = 0;
foreach ($a as $key=>$val){
	$c = $val;
	if($c == 2){
		$para++;
		$k .= $key .",";
	}
}
echo $para;
echo $k;*/
/*
$array = array(1,2,3,4,4,5,5); 
$temp = array(); 
$result = array(); 
foreach($array as $v) 
{ 
 if (!in_array($v,$temp)) {
	 $temp[] = $v;
	 } else {
	 $result[] = $v;
	 } 
} 
var_dump($result); 
*/
  
 
//array_multisort($process_result->getPara(), SORT_ASC, SORT_NUMERIC);
/*
$array[0] = array('key_a' => 'z', 'key_b' => 'c');
$array[1] = array('key_a' => 'x', 'key_b' => 'b');
$array[2] = array('key_a' => 'y', 'key_b' => 'a');

function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}

usort($array, build_sorter('key_b'));

foreach ($array as $item) {
    echo $item['key_a'] . ', ' . $item['key_b'] . "\n";
}
*/


/*

echo "<br>";
$strid =0;
$mass = [4,6,7,8,9,11,14];
$res = "";
$mass_sum = array();
$a = 0;
$mass_sum[] = 45;
$max = max ($mass_sum);
echo $max;


if($mass[1]+1 == $mass[2] && $mass[2]+1 == $mass[3] && $mass[3]+1 == $mass[4] ){
$mass_sum1 =  $mass[1]+$mass[2]+$mass[3]+$mass[4]+$mass[5];
$mass_sum[] = $mass_sum1;
echo"<pre>";
print_r($mass_sum);
echo"</pre>";
$a = 5;
}
echo "$a";
/*
echo "<br>";
$st = "1234579";
if($st[0]+1 == $st[1] && $st[1]+1 == $st[2] && $st[2]+1 == $st[3] && $st[3]+1 == $st[4] ){
	echo "ok";
}else{
	echo "n";
}
*/


?>