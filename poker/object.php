<?php
include("Kart.php");


$player_one = new Player_one(DbConn::getInstance() );
$player_one->setKart();
$player_one->setBalance();
///$player_one_balance --РАссматривай как свойство класса или просто обьяви до if !!!!!!!!!!!!!!!
/*if($_SERVER['REQUEST_METHOD']=='POST'){
			$player_one_balance = $_POST['player_one_balance'];
			$player_one->saveData($player_one_balance);
}*/

$player_one->setId($player_one->getKart() );
$id_one = $player_one->getId();
$id_one = rtrim($id_one,",");


////////////////////////2/////////////////////
$player_two = new Player_two(DbConn::getInstance() );
$player_two->setKart($id_one);
$player_two->setBalance();

/*if($_SERVER['REQUEST_METHOD']=='POST'){
			$player_two_balance = $_POST['player_two_balance'];
			$player_two->saveData($player_two_balance);
}*/

$player_two->setId($player_two->getKart() );
$id_two = $player_two->getId();
$id_two = rtrim($id_two,",");
$id_one_two = $id_one.",".$player_two->getId();
$id_one_two = rtrim($id_one_two,",");



////////////////////////3/////////////////////
$player_three= new Player_three(DbConn::getInstance() );
$player_three->setKart($id_one_two);
$player_three->setBalance();

/*if($_SERVER['REQUEST_METHOD']=='POST'){
			$player_three_balance = $_POST['player_three_balance'];
			$player_three->saveData($player_three_balance);
}*/

/*
foreach ($player_three->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
*////////////////////Не помню
$player_three->setId($player_three->getKart() );
$id_three = $player_three->getId();
$id_three = rtrim($id_three,",");
$id_one_two_three = $id_one.",".$player_two->getId().$player_three->getId();
$id_one_two_three = rtrim($id_one_two_three,",");
$id_one_two_three ;

///////////////////////////////////// КОЛОДА
$koloda = new Koloda(DbConn::getInstance() );
$koloda->setKolodaKart($id_one_two_three);

$koloda->setStolKartThree($id_one_two_three);
$koloda->setIdThree($koloda->getStolKartThree() );

//$koloda->setStolKartThree($id_one_two_three);
//$koloda->setIdThree($koloda->getStolKartThree() );

$four_kart = $id_one_two_three.",".$koloda->getIdThree();
$four_kart = rtrim($four_kart,",");

$koloda->setStolKartTwo($four_kart);
$koloda->setIdTwo($koloda->getStolKartTwo() );

$five_kart = $four_kart.",".$koloda->getIdTwo();
$five_kart = rtrim($five_kart,",");
//var_dump($five_kart);

$koloda->setStolKartFive($five_kart);
$koloda->setIdFive($koloda->getStolKartFive() );

$all_stol_kart = $koloda->getIdThree().$koloda->getIdTwo().$koloda->getIdFive();


/////////////////////////////////////////Принимаю данные от ajax id карт 
$id_kart_players_one = "";
$id_kart_players_two = "";
$id_kart_players_three ="" ;
$all_stol_kart_game = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
			$id_kart_players_one = $_POST['player_one_kart'];
			$id_kart_players_two = $_POST['player_two_kart'];
			$id_kart_players_three = $_POST['player_three_kart'];
			$all_stol_kart_game = $_POST['all_stol_kart'];
}

$id_kart_players_one .=",".$all_stol_kart_game;
$id_kart_players_one = rtrim($id_kart_players_one,",");

$id_kart_players_two .=",".$all_stol_kart_game;
$id_kart_players_two = rtrim($id_kart_players_two,",");

$id_kart_players_three .=",".$all_stol_kart_game;
$id_kart_players_three = rtrim($id_kart_players_three,",");


///////////////////////////////////////////////////RESULT//////////////////////////////////////
$game_end = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
		$game_end = $_POST['game_end'];
		if(	$game_end == 1){

$process_result = new ProcessResult(DbConn::getInstance() );
$process_result->setKart($id_kart_players_one);
 $process_result->setQuantity();//Значние карт от 2,3,4... до туза
$process_result->setType();//Значение two,three
$process_result->setSuit();//пика,крест..., масть карт
 

$process_result->AllSet();//Вызывает все функции para....fullHouse
$process_result->getResult() ;//выбирает максимальное значение комбинаций карт -para....fullHouse

$process_result->result ;/// - мах значение


$process_result->result_one_quantity;//Перове значение после если комбинаций одинаковые

$process_result->result_one_quantity_two;//Второе значение после если комбинаций одинаковые

$process_result->setOneQuantity() ;//возвращает $process_result->result (от 1 до 9) и значение setOneQuantity - если одинаковые комбинаций
/*
foreach ($process_result->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
*/

$process_result2 = new ProcessResult(DbConn::getInstance() ) ;
$process_result2->setKart($id_kart_players_two)  ;
$process_result2->setQuantity();
$process_result2->setType();
$process_result2->setSuit();

$process_result2->AllSet();
$process_result2->getResult() ;

$process_result2->result;

$process_result2->result_one_quantity;

$process_result2->result_one_quantity_two;



$process_result2->setOneQuantity();

//var_dump($process_result2);
/*
foreach ($process_result2->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
*/

$process_result3 = new ProcessResult(DbConn::getInstance() ) ;
$process_result3->setKart($id_kart_players_three)  ;
$process_result3->setQuantity();
$process_result3->setType();
$process_result3->setSuit();

 $process_result3->AllSet();
$process_result3->getResult();

$process_result3->result;


$process_result3->result_one_quantity;
$process_result3->result_one_quantity_two;


$process_result3->setOneQuantity();



	$wins = new PlayerWins();
 $wins->wins($process_result,$process_result2,$process_result3) ;

	}
}
/*
foreach ($process_result3->getKart() as $item){
	$a = $item['image'];
	echo '<img src="'."image/$a".'"/>';
}
*/








 
 





///////////////Сделать новый файл отдельно от классов, одни обьекты!!! и там пробываеть аякс запросы






?>