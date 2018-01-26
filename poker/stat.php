<?php 
$a = " ";$b = " w2";
if($_SERVER['REQUEST_METHOD']=='POST'){

$players_one = $_POST['players_one'];

if($players_one == 1){
	$a  = 6;
	$b = "54";
	}
}



$c = $a;

	echo '
	<p class = "okey">
		'.$a.'
	</p>
	';
	echo '
	<p class = "hello">
		'.$c.'
	</p>
	';
?>
