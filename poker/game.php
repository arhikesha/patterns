<?php
include_once ("object.php");
//include_once ("players.php");
//include_once ("stat.php");

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/style.css" rel="stylesheet">
 <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
 <script type="text/javascript" src="js/jquery-ui.min.js"></script>
 <script type="text/javascript" src="js/main.js"></script>
 </head>


 <div class = "col-md-2 player_one">
 <h3>Первый игрок</h3>
 <a href ="#"class = "btn btn-primary check" id = "ok1">Готов</a>
 <?php
foreach ($player_one->getKart() as $item){
	$a = $item['image'];
	echo '<img  class = "img1" src="'."image/$a".'"/>';
	echo '<img  class = "img_ob1" src=""/>';
}
?>
<h2>
 
<?php
foreach ($player_one->getBalance() as $item){
		$balance_one = $item['score'];
}
echo '
<span id = "player_one_balance" data-action = "'.$balance_one.' " >'.$balance_one.'$</span>
<span id = "player_one_kart" data-action = "'.$id_one.' " >'.$id_one.'id</span>
';

?>

</h2>
	<div class = "menu1">
		<img class = "fishka25" src="image/fishka25.jpg"/>;
		<img class = "fishka50" src="image/fishka50.jpg"/>;
		<img class = "fishka100" src="image/fishka100.jpg"/>;
		<img class = "fishka200" src="image/fishka200.jpg"/>;
		<img class = "fishka500" src="image/fishka500.jpg"/>;
		<br>
		<a href ="#"class = "btn btn-primary btn-sm bet " id = "bet_one" >Bet</a>
		<a href ="#"class = "btn btn-primary btn-sm call" id = "call_one">Call</a>
		<br>
		<a href ="#"class = "btn btn-primary btn-sm raise"id = "raise_one">raise</a>
		<a href ="#"class = "btn btn-primary btn-sm fold"id = "fold_one">fold</a>
		<br>
		<a href ="#"class = "btn btn-primary check"id = "check_one">check</a>
	</div>
 </div>
																															<!--Стол-->
  <div class = "col-md-8">
		<div class="stol">
		
 <?php

foreach ($koloda->getStolKartThree() as $item){
	$a = $item['image'];
	echo '<img class = "flop" src="'."image/$a".'"/>';
}

foreach ($koloda->getStolKartTwo() as $item){
	$a = $item['image'];
	echo '<img  class = "tern" src="'."image/$a".'"/>';
}
foreach ($koloda->getStolKartFive() as $item){
	$a = $item['image'];
	echo '<img class = "river" src="'."image/$a".'"/>';
	
}
echo '<span id = "all_stol_kart" data-action ="'.$all_stol_kart.'"></span>';
?>
		<div class = "bank" >
<?php
echo' 
<p class = "bank_view" data-action = "0"> 0 </p>

';

?>
		</div>
	</div>
	<span id = "bet_1"></span>
	<span id = "wager_1"></span>
	<span id = "bet_3"></span>
	<span id = "wager_3"></span>
	<span id = "bet_2"></span>
	<span id = "wager_2"></span>
 </div>
 
  <div class = "col-md-2 player_two">
	<h3>Второй игрок</h3>
	<a href ="#"class = "btn btn-primary check" id = "ok2">Готов</a>
<?php

foreach ($player_two->getKart() as $item){
	$a = $item['image'];
	echo '<img class = "img2" src="'."image/$a".'"/>';
	echo '<img  class = "img_ob2" src=""/>';
}
?>

<h2>
<?php
foreach ($player_two->getBalance() as $item){
		$balance_two = $item['score'];
}
echo '
<span id = "player_two_balance" data-action = "'.$balance_two.' " >'.$balance_two.'$</span>
<span id = "player_two_kart" data-action = "'.$id_two.' " >'.$id_two.'id</span>
';
?>
</h2>
	<div class = "menu2">
		<img class = "fishka25" src="image/fishka25.jpg"/>;
		<img class = "fishka50" src="image/fishka50.jpg"/>;
		<img class = "fishka100" src="image/fishka100.jpg"/>;
		<img class = "fishka200" src="image/fishka200.jpg"/>;
		<img class = "fishka500" src="image/fishka500.jpg"/>;
		<br>
		<a href ="#"class = "btn btn-primary btn-sm bet "id = "bet_two">Bet</a>
		<a href ="#"class = "btn btn-primary btn-sm call"id = "call_two">Call</a>
		<br>
		<a href ="#"class = "btn btn-primary btn-sm raise">raise</a>
		<a href ="#"class = "btn btn-primary btn-sm fold"id = "fold_two">fold</a>
		<br>
		<a href ="#"class = "btn btn-primary check"id = "check_two">check</a>
	</div>
 </div>
 
  <div class = "col-md-3 ">
 
 </div>
 
 <div class = "col-md-6 player_three">
 
	<div class = "col-md-5 image">
 <?php
foreach ($player_three->getKart() as $item){
	$a = $item['image'];
	echo '<img class = "img3" src="'."image/$a".'"/>';
		echo '<img  class = "img_ob3" src=""/>';
}
 ?>
	</div> 
	<div class = "col-md-7">
		<div class ="col-md-3 balance">
			<h2>
<?php
foreach ($player_three->getBalance() as $item){
		$balance_three = $item['score'];
}
echo '
<span id = "player_three_balance" data-action = "'.$balance_three.' " >'.$balance_three.'$</span>
<span id = "player_three_kart" data-action = "'.$id_three.' " >'.$id_three.'id</span>

';
?>
</h2>
		</div>
		<div class ="col-md-9">
		<h4>Третий игрок</h4>
		<a href ="#"class = "btn btn-primary check" id = "ok3">Готов</a>
	<div class = "menu3">
		<img class = "fishka25" src="image/fishka25.jpg"/>;
		<img class = "fishka50" src="image/fishka50.jpg"/>;
		<img class = "fishka100" src="image/fishka100.jpg"/>;
		<img class = "fishka200" src="image/fishka200.jpg"/>;
		<img class = "fishka500" src="image/fishka500.jpg"/>;
		<br>
		<a href ="#"class = "btn btn-primary btn-sm bet "id = "bet_three">Bet</a>
		<a href ="#"class = "btn btn-primary btn-sm call"id = "call_three">Call</a>
		<br>
		<a href ="#"class = "btn btn-primary btn-sm raise">raise</a>
		<a href ="#"class = "btn btn-primary btn-sm fold"id = "fold_three">fold</a>
		<br>
		<a href ="#"class = "btn btn-primary check"id = "check_three">check</a>
			</div>	
		</div>
	</div>
 </div>
 
  <div class = "col-md-3">
 
 </div>
 


 
 </html>