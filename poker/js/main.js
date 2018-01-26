$(document).ready(function() {
	var game = 3;
	var round  = 0;
	var stavka = 25
	var stroke_one = 0;
	var stroke_two = 0;
	var stroke_three = 0;
	var player_one_balance = $('#player_one_balance').data('action');
	var player_two_balance = $('#player_two_balance').data('action');
	var player_three_balance = $('#player_three_balance').data('action');
	var player_one_kart = $('#player_one_kart').data('action');
	var player_two_kart = $('#player_two_kart').data('action');
	var player_three_kart = $('#player_three_kart').data('action');
	var all_stol_kart = $('#all_stol_kart').data('action');
	var fold_one = 1;
	var fold_two = 1;
	var fold_three = 1;
	var bet_1 = 0;
	var bet_2 = 0;
	var bet_3 = 0;
	var wager_1 = 0;
	var wager_2 = 0;
	var wager_3 = 0;
	var bank = $('.bank_view').data('action');

	///Показывать весь расклад сразу
$('.flop').hide();	
$('.tern').hide();	
$('.river').hide();	

if(game % 5 == 1){
		stavka *=2;
	}
/////////////////////////
if(game % 3 == 0){
$('.img_ob1').hide();
$('.menu2').hide();	
$('.img2').hide();
$('.img_ob2').attr("src","image/obloshka.jpg");
$('.menu3').hide();	
$('.img3').hide();
$('.img_ob3').attr("src","image/obloshka.jpg");
player_one_balance -= stavka;
$('#player_one_balance').html(player_one_balance +"$");
player_two_balance -= stavka;
$('#player_two_balance').html(player_two_balance +"$");
player_three_balance -= stavka;
$('#player_three_balance').html(player_three_balance +"$");
sbank = stavka * 3;
bank +=sbank;
$('.bank_view').html(bank+"$");
}	
	
if(game % 3 == 1){
$('.img_ob2').hide();
$('.menu1').hide();	
$('.img1').hide();
$('.img_ob1').attr("src","image/obloshka.jpg");
$('.menu3').hide();	
$('.img3').hide();
$('.img_ob3').attr("src","image/obloshka.jpg");
player_one_balance -= stavka;
$('#player_one_balance').html(player_one_balance +"$");
player_two_balance -= stavka;
$('#player_two_balance').html(player_two_balance +"$");
player_three_balance -= stavka;
$('#player_three_balance').html(player_three_balance +"$");
sbank = stavka * 3;
bank +=sbank;
$('.bank_view').html(bank+"$");
}	
	
if(game % 3 == 2){
$('.img_ob3').hide();
$('.menu1').hide();	
$('.img1').hide();
$('.img_ob1').attr("src","image/obloshka.jpg");
$('.menu2').hide();	
$('.img2').hide();
$('.img_ob2').attr("src","image/obloshka.jpg");
player_one_balance -= stavka;
$('#player_one_balance').html(player_one_balance +"$");
player_two_balance -= stavka;
$('#player_two_balance').html(player_two_balance +"$");
player_three_balance -= stavka;
$('#player_three_balance').html(player_three_balance +"$");
sbank = stavka * 3;
bank +=sbank;
$('.bank_view').html(bank+"$");
}		

/////////////////////////////////////////	
function Zero(){
	if( (player_one_balance == 0 && player_three_balance == 0 ) ||
	(player_one_balance == 0 && player_two_balance == 0) ||
 (player_three_balance == 0 && player_two_balance == 0) ){
		$('.flop').show();
			$('.tern').show();
				$('.river').show();
	}
}

function getStroke(){
if(stroke_one != 0 && stroke_two != 0 && stroke_three != 0 ){
	if(bet_1 == bet_2 && bet_2 == bet_3 && bet_1 == bet_3 ||
	(player_one_balance == 0 && (bet_1 != 0 || wager_1 !=0) && bet_2 == bet_3) ||
	(player_three_balance == 0 && (bet_3 != 0 || wager_3 !=0) && bet_1 == bet_2) ||
	(player_two_balance == 0 && (bet_2 != 0 || wager_2 !=0) &&  bet_1 == bet_3) || 
	(player_one_balance == 0 && player_three_balance == 0 ) ||
	(player_two_balance == 0 && player_one_balance == 0 ) ||
	(player_two_balance == 0 && player_three_balance == 0 ) ){ 	
	
		round++;
		if(round == 1){
					wager_1 = bet_1;
					wager_2 = bet_2;
					wager_3 = bet_3;
			$('#wager_1').html(wager_1);
			$('#wager_2').html(wager_2);
			$('#wager_3').html(wager_3);
			$('.flop').show();
		}	else if(round == 2){
					$('.tern').show();
					wager_1 += bet_1;
					wager_2 += bet_2;
					wager_3 += bet_3;
		$('#wager_1').html(wager_1);
		$('#wager_2').html(wager_2);
		$('#wager_3').html(wager_3);
				}else if(round == 3){
					$('.river').show();
					wager_1 += bet_1;
					wager_2 += bet_2;
					wager_3 += bet_3;
		$('#wager_1').html(wager_1);
		$('#wager_2').html(wager_2);
		$('#wager_3').html(wager_3);
				}
				
		bank += bet_1;		
		$('.bank_view').html(bank+"$");
		bet_1 = 0;
		$('#bet_1').html(bet_1);
		
		bank = bank + bet_2;
		$('.bank_view').html(bank+"$");
		bet_2 = 0;
		$('#bet_2').html(bet_2);
		
		bank = bank + bet_3;
		$('.bank_view').html(bank+"$");
		bet_3 = 0;
		$('#bet_3').html(bet_3);
		
		$('#round').html(round);
		////вспомнить где был вызов аякса!!!
					$.ajax({
		url:'object.php',
		data:{player_one_kart:player_one_kart,player_two_kart:player_two_kart,
					player_three_kart:player_three_kart,all_stol_kart:all_stol_kart,
					game_end:1},
		type:'POST',
		dataType:'html',
		cache:false,
		 success:function (data) {
		$('.bank').html(data);
        },
		});
		 
		stroke_one = 0;
		stroke_two = 0;
		stroke_three = 0;
		
			
		
		}
	}if(stroke_one != 0 && stroke_two != 0 && fold_three == 0  ){
		if(bet_1 == bet_2 || (player_one_balance == 0 && (bet_1 != 0 || wager_1 !=0)) ||
			(player_two_balance == 0 && (bet_2 != 0 || wager_2 !=0))){
			round++;
			if(round == 1){
					wager_1 = bet_1;
					wager_2 = bet_2;
			$('#wager_1').html(wager_1);
			$('#wager_2').html(wager_2);
			$('.flop').show();
		}	else if(round == 2){
					$('.tern').show();
					wager_1 += bet_1;
					wager_2 += bet_2;
		$('#wager_1').html(wager_1);
		$('#wager_2').html(wager_2);
				}else if(round == 3){
					$('.river').show();
					wager_1 += bet_1;
					wager_2 += bet_2;
		$('#wager_1').html(wager_1);
		$('#wager_2').html(wager_2);
				}
			
			bank = bank + bet_1;
		$('.bank_view').html(bank+"$");
		bet_1 = 0;
		$('#bet_1').html(bet_1);
		
		bank = bank + bet_2;
		$('.bank_view').html(bank+"$");
		bet_2 = 0;
		$('#bet_2').html(bet_2);
		
		
		
		stroke_one = 0;
		stroke_two = 0;
		}
	}if(stroke_two != 0 && stroke_three != 0 && fold_one == 0  ){
		if(bet_2 == bet_3 || (player_three_balance == 0 && (bet_3 != 0 || wager_3 !=0)) ||
			(player_two_balance == 0 && (bet_2 != 0 || wager_2 !=0)) ){
			
			round++;
			if(round == 1){
					wager_3 = bet_3;
					wager_2 = bet_2;
			$('#wager_3').html(wager_3);
			$('#wager_2').html(wager_2);
			$('.flop').show();
		}	else if(round == 2){
					$('.tern').show();
					wager_3 += bet_3;
					wager_2 += bet_2;
		$('#wager_3').html(wager_3);
		$('#wager_2').html(wager_2);
				}else if(round == 3){
					$('.river').show();
					wager_3 += bet_3;
					wager_2 += bet_2;
		$('#wager_3').html(wager_3);
		$('#wager_2').html(wager_2);
				}
			
			bank = bank + bet_2;
		$('.bank_view').html(bank+"$");
		bet_2 = 0;
		$('#bet_2').html(bet_2);
		
		bank = bank + bet_3;
		$('.bank_view').html(bank+"$");
		bet_3 = 0;
		$('#bet_3').html(bet_3);
		
			
		stroke_two = 0;
		stroke_three = 0;
				
		}
	}if(stroke_one != 0 && stroke_three != 0 && fold_two == 0 ){
		if(bet_1 == bet_3 || (player_three_balance == 0 && (bet_3 != 0 || wager_3 !=0)) ||
			(player_one_balance == 0 && (bet_1 != 0 || wager_1 !=0))	){
			round++;
			if(round == 1){
					wager_3 = bet_3;
					wager_1 = bet_1;
			$('#wager_3').html(wager_3);
			$('#wager_1').html(wager_1);
			$('.flop').show();
		}	else if(round == 2){
					$('.tern').show();
					wager_3 += bet_3;
					wager_1 += bet_1;
		$('#wager_3').html(wager_3);
		$('#wager_1').html(wager_1);
				}else if(round == 3){
					$('.river').show();
					wager_3 += bet_3;
					wager_1 += bet_1;
		$('#wager_3').html(wager_3);
		$('#wager_1').html(wager_1);
				}
			
		bank = bank + bet_1;
		$('.bank_view').html(bank+"$");
		bet_1 = 0;
		$('#bet_1').html(bet_1);
		
		bank = bank + bet_3;
		$('.bank_view').html(bank+"$");
		bet_3 = 0;
		$('#bet_3').html(bet_3);
		
			
		stroke_one = 0;
		stroke_three = 0;
				
	
		}
		
	}		 	
	
}

	
function ClickOne(){
	$('.menu1').hide();	
	$('.img1').hide();
	$('.img_ob1').attr("src","image/obloshka.jpg");
	$('.img_ob1').show();
		stroke_one = stroke_one + 1;
		//Zero();
		getStroke();
	if(fold_two !=0){
				$('#ok2').css('display','block');
	}else if(fold_three !=0 && fold_two == 0){
		$('#ok3').css('display','block');
	
	}
}	

function ClickTwo(){
	$('.menu2').hide();	
	$('.img_ob2').show();
	$('.img2').hide();
	$('.img_ob2').attr("src","image/obloshka.jpg");
	stroke_two = stroke_two +1;
	//Zero();
	getStroke();
	if(fold_three !=0){
				$('#ok3').css('display','block');
	}else if(fold_one !=0 && fold_three == 0){
		$('#ok1').css('display','block');
		
	}
}	

function ClickThree(){
	$('.menu3').hide();
	$('.img_ob3').show();
	$('.img3').hide();
	$('.img_ob3').attr("src","image/obloshka.jpg");
		stroke_three = stroke_three +1;
		//Zero();
		getStroke();
	if(fold_one !=0){
			$('#ok1').css('display','block');
	}else if(fold_two !=0 && fold_one == 0){
		$('#ok2').css('display','block');
	
	}
}	
	///////////////////////////////
$('.menu1 >.fishka25').on('click',function () {
	if(player_one_balance > 0 && player_one_balance - 25 >=0){
	bet_1 += 25;
	$('#bet_1').html(bet_1);
	player_one_balance = player_one_balance - 25;
		$('#player_one_balance').html(player_one_balance +"$");
	}else{
		return false;
		}
});	
$('.menu1 >.fishka50').on('click',function () {
		if(player_one_balance > 0 && player_one_balance - 50 >=0){
	bet_1 = bet_1 + 50;
	$('#bet_1').html(bet_1);
		player_one_balance = player_one_balance - 50;
		$('#player_one_balance').html(player_one_balance +"$");
		}else{
			return false;
		}
});		
$('.menu1 >.fishka100').on('click',function () {
if(player_one_balance > 0 && player_one_balance - 100 >= 0){
	bet_1 = bet_1 + 100;
	$('#bet_1').html(bet_1);
	player_one_balance = player_one_balance - 100;
		$('#player_one_balance').html(player_one_balance +"$");
			}else{
			return false;
		}
});	
$('.menu1 >.fishka200').on('click',function () {
if(player_one_balance > 0 && player_one_balance - 200 >=0){
	bet_1 = bet_1 + 200;
	$('#bet_1').html(bet_1);
	player_one_balance = player_one_balance - 200;
		$('#player_one_balance').html(player_one_balance +"$");
			}else{
			return false;
		}
});
$('.menu1 >.fishka500').on('click',function () {
	if(player_one_balance > 0 && player_one_balance - 500 >= 0){
	bet_1 = bet_1 + 500;
	$('#bet_1').html(bet_1);
	player_one_balance = player_one_balance - 500;
		$('#player_one_balance').html(player_one_balance +"$");
			}else{
			return false;
		}
});
///////////////////
$('.menu2 >.fishka25').on('click',function () {
	if(player_two_balance > 0 && player_two_balance - 25 >=0){
	bet_2 = bet_2 + 25;
	$('#bet_2').html(bet_2);
	player_two_balance = player_two_balance -25;
		$('#player_two_balance').html(player_two_balance+"$");
		}else{
			return false;
		}
});	
$('.menu2 >.fishka50').on('click',function () {
	if(player_two_balance > 0 && player_two_balance - 50 >=0){
	bet_2 = bet_2 + 50;
	$('#bet_2').html(bet_2);
	player_two_balance = player_two_balance - 50;
		$('#player_two_balance').html(player_two_balance+"$");
		}else{
			return false;
		}
});		
$('.menu2 >.fishka100').on('click',function () {
		if(player_two_balance > 0 && player_two_balance - 100 >=0){
	bet_2 = bet_2 + 100;
	$('#bet_2').html(bet_2);
	player_two_balance = player_two_balance - 100;
		$('#player_two_balance').html(player_two_balance+"$");
			}else{
			return false;
		}
});	
$('.menu2 >.fishka200').on('click',function () {
	if(player_two_balance > 0 && player_two_balance - 200 >=0){
	bet_2 = bet_2 + 200;
	$('#bet_2').html(bet_2);
	player_two_balance = player_two_balance - 200;
	$('#player_two_balance').html(player_two_balance+"$");
		}else{
			return false;
		}
});
$('.menu2 >.fishka500').on('click',function () {
	if(player_two_balance > 0 && player_two_balance - 500 >=0){
	bet_2 = bet_2 + 500;
	$('#bet_2').html(bet_2);
	player_two_balance = player_two_balance - 500;
		$('#player_two_balance').html(player_two_balance+"$");
			}else{
			return false;
		}
});
/////////////////////
$('.menu3 >.fishka25').on('click',function () {
		if(player_three_balance > 0 && player_three_balance - 25 >= 0){
	bet_3 = bet_3 + 25;
	$('#bet_3').html(bet_3);
		player_three_balance = player_three_balance - 25;
		$('#player_three_balance').html(player_three_balance+"$");
		}else{
				return false;
		}
});	
$('.menu3 >.fishka50').on('click',function () {
	if(player_three_balance > 0 && player_three_balance - 50 >= 0){
	bet_3 = bet_3 + 50;
	$('#bet_3').html(bet_3);
		player_three_balance = player_three_balance - 50;
		$('#player_three_balance').html(player_three_balance+"$");
		}else{
				return false;
		}
});		
$('.menu3 >.fishka100').on('click',function () {
		if(player_three_balance > 0 && player_three_balance - 100 >= 0){
	bet_3 = bet_3 + 100;
	$('#bet_3').html(bet_3);
		player_three_balance = player_three_balance - 100;
		$('#player_three_balance').html(player_three_balance+"$");
		}else{
				return false;
		}
});	
$('.menu3 >.fishka200').on('click',function () {
	if(player_three_balance > 0 && player_three_balance - 200 >= 0){
	bet_3 = bet_3 + 200;
	$('#bet_3').html(bet_3);
		player_three_balance = player_three_balance - 200;
		$('#player_three_balance').html(player_three_balance+"$");
			}else{
				return false;
		}
});
$('.menu3 >.fishka500').on('click',function () {
	if(player_three_balance > 0 && player_three_balance - 500 >= 0){
	bet_3 = bet_3 + 500;
	$('#bet_3').html(bet_3);
		player_three_balance = player_three_balance - 500;
		$('#player_three_balance').html(player_three_balance+"$");
			}else{
			return false;
		}
});

	////////////////
$('#bet_one').on('click',function (e) {
	e.preventDefault();
	if(player_one_balance >= 0 ){
				if(bet_1 >0 ){
						if(bet_1 >= bet_2 && bet_1 >= bet_3){
								
	ClickOne();
	}else{
			alert ("Уровняйте ставку");
	}
	}else{
		alert ("Сделайте ставку");
	}
	}else{
		return false;
	}
});

$('#call_one').on('click',function(e){
	e.preventDefault();
	if( fold_three != 0 && player_three_balance > 0 ){
	if(bet_1 == 0 ){
				bet_1 = bet_3;
					$('#bet_1').html(bet_1+"$");
		}else{
			if(player_one_balance  >= 0){
			player_one_balance += bet_1;
			$('#player_one_balance').html(player_one_balance+"$");
			bet_1 = bet_3;
				$('#bet_1').html(bet_1+"$");
			}
		} 
	if(player_one_balance - bet_1 > 0){	
		if( bet_1 == bet_3 ){
		$('#bet_1').html(bet_1+"$");
		player_one_balance -= bet_1;
	$('#player_one_balance').html(player_one_balance+"$");
		ClickOne();
		}
		}else{
			bet_1 = player_one_balance;
			$('#bet_1').html(bet_1+"$");
			player_one_balance =0;
			$('#player_one_balance').html(player_one_balance+"$");
			ClickOne();
			}
		}/* else{
			if(player_one_balance - bet_1 > 0){
			player_one_balance += bet_1;
					bet_1 = bet_2;
				$('#bet_1').html(bet_1+"$");
		player_one_balance -= bet_1;
	$('#player_one_balance').html(player_one_balance+"$");
		ClickOne();
			}
		} */
if( (fold_three == 0 || player_three_balance == 0) && fold_two != 0 ){
	if(bet_1 == 0 ){
				bet_1 = bet_2;
					$('#bet_1').html(bet_1+"$");
		}else{
			if(player_one_balance  >= 0){
			player_one_balance += bet_1;
			$('#player_one_balance').html(player_one_balance+"$");
			bet_1 = bet_2;
				$('#bet_1').html(bet_1+"$");
			}
		} 
	if(player_one_balance - bet_1 > 0){	
		if( bet_1 == bet_2 ){
		$('#bet_1').html(bet_1+"$");
		player_one_balance -= bet_1;
	$('#player_one_balance').html(player_one_balance+"$");
		ClickOne();
		}
		}else{
			bet_1 = player_one_balance;
			$('#bet_1').html(bet_1+"$");
			player_one_balance = 0;
			$('#player_one_balance').html(player_one_balance+"$");
			ClickOne();
			}
		}
});

$('#fold_one').on('click',function(e){
	e.preventDefault();
	$('.img1').hide();
	$('.menu1').hide();	
	if(fold_two !=0){
		$('#ok2').css('display','block');
	}
	fold_one = 0;
	bank += bet_1;
	$('.bank_view').html(bank+"$");
	bet_1 = 0
	getStroke();
	$('#bet_1').html(bet_1+"$");
});

$('#check_one').on('click',function(e){
	e.preventDefault();
		if(bet_1 >= bet_2 && bet_1 >= bet_3 || player_one_balance == 0){
			if(bet_1 >=0){
		ClickOne();
	$('#player_one_balance').html(player_one_balance +"$");
	$('.bank_view').html(bank+"$");
		}
	}
});

$('#bet_two').on('click',function (e) {
	e.preventDefault();
		if(player_two_balance >= 0 ){
				if(bet_2 >0 ){
						if(bet_2 >= bet_1 && bet_2 >= bet_3){
								ClickTwo()
	}else{
			alert ("Уровняйте ставку");
	}
	}else{
		alert ("Сделайте ставку");
	}
	}else{
		player_two_balance = 0;
		alert ("bankrot");
	}
});

$('#call_two').on('click',function(e){
	e.preventDefault();
	if( fold_one != 0){
	if(bet_2 == 0 ){
				bet_2 = bet_1;
					$('#bet_2').html(bet_2+"$");
		}else{
			if(player_two_balance  >= 0){
			player_two_balance += bet_2;
			$('#player_two_balance').html(player_two_balance+"$");
			bet_2 = bet_1;
				$('#bet_2').html(bet_2+"$");
			}
		} 
	if(player_two_balance - bet_2 > 0){	
		if( bet_2 == bet_1 ){
		$('#bet_2').html(bet_2+"$");
		player_two_balance -= bet_2;
	$('#player_two_balance').html(player_two_balance+"$");
		ClickTwo();
		}
		}else{
			bet_2 =player_two_balance;
			$('#bet_2').html(bet_2+"$");
			player_two_balance =0;
			$('#player_two_balance').html(player_two_balance+"$");
			ClickTwo();
			}
		}else{
		player_two_balance += bet_2;
					bet_2 = bet_3;
				$('#bet_2').html(bet_2+"$");
		player_two_balance -= bet_2;
	$('#player_two_balance').html(player_two_balance+"$");
		ClickTwo();
		}
if( fold_one == 0 && fold_three != 0){
	if(bet_2 == 0 ){
				bet_2 = bet_3;
					$('#bet_2').html(bet_2+"$");
		}else{
			if(player_two_balance  >= 0){
			player_two_balance += bet_2;
			$('#player_two_balance').html(player_two_balance+"$");
			bet_2 = bet_3;
				$('#bet_2').html(bet_2+"$");
			}
		} 
	if(player_two_balance - bet_2 > 0){	
		if( bet_2 == bet_3 ){
		$('#bet_2').html(bet_2+"$");
		player_two_balance -= bet_2;
	$('#player_two_balance').html(player_two_balance+"$");
		ClickTwo();
		}
		}else{
			bet_2 =player_two_balance;
			$('#bet_2').html(bet_2+"$");
			player_two_balance =0;
			$('#player_two_balance').html(player_two_balance+"$");
			ClickTwo();
			}
		}
});

$('#fold_two').on('click',function(e){
	e.preventDefault();
	$('.img2').hide();
	$('.menu2').hide();	
	if(fold_three !=0){
		$('#ok3').css('display','block');
	}
	fold_two = 0;
	bet_2 = 0
	getStroke();
	$('#bet_2').html(bet_2+"$");
});
$('#check_two').on('click',function(e){
	e.preventDefault();
	if(bet_2 >= bet_1 && bet_2 >= bet_3 || player_two_balance == 0){
		if(bet_2 >=0 ){
		ClickTwo();
	$('#player_two_balance').html(player_two_balance+"$");
	$('.bank_view').html(bank+"$");
		}
	}
});



$('#bet_three').on('click',function (e) {
	e.preventDefault();
		if(player_three_balance >= 0 ){
				if(bet_3 >0 ){
						if(bet_3 >= bet_1 && bet_3 >= bet_2){
							if(round == 1){
	
	}
	ClickThree();
						}else{
							alert ("Уровняйте ставку");
						}
		}else{
					alert ("Сделайте ставку");
		}
	}else{
		player_three_balance = 0;
		alert ("bankrot");
	}
});

$('#call_three').on('click',function(e){
		e.preventDefault();
	if( fold_two != 0){
	if(bet_3 == 0 ){
				bet_3 = bet_2;
					$('#bet_3').html(bet_3+"$");
		}else{
			if(player_three_balance  >= 0){
			player_three_balance += bet_3;
			$('#player_three_balance').html(player_three_balance+"$");
			bet_3 = bet_2;
				$('#bet_3').html(bet_3+"$");
			}
		} 
	if(player_three_balance - bet_3 > 0){	
		if( bet_3 == bet_2 ){
		$('#bet_3').html(bet_3+"$");
		player_three_balance -= bet_3;
	$('#player_three_balance').html(player_three_balance+"$");
		ClickThree();
		}
		}else{
			bet_3 = player_three_balance;
			$('#bet_3').html(bet_3+"$");
			player_three_balance = 0;
			$('#player_three_balance').html(player_three_balance+"$");
			ClickThree();
			}
		}else{
			if(player_three_balance - bet_1 > 0){
		player_three_balance += bet_3;
					bet_3 = bet_1;
				$('#bet_1').html(bet_1+"$");
		player_three_balance -= bet_1;
	$('#player_three_balance').html(player_three_balance+"$");
		ClickThree();
			}
		}
if( fold_two == 0 && fold_one != 0){
	if(bet_3 == 0 ){
				bet_3 = bet_1;
					$('#bet_3').html(bet_3+"$");
		}else{
			if(player_three_balance  >= 0){
			player_three_balance += bet_3;
			$('#player_three_balance').html(player_three_balance+"$");
			bet_3 = bet_1;
				$('#bet_3').html(bet_3+"$");
			}
		} 
	if(player_three_balance - bet_3 > 0){	
		if( bet_3 == bet_1 ){
		$('#bet_3').html(bet_3+"$");
		player_three_balance -= bet_3;
	$('#player_three_balance').html(player_three_balance+"$");
		ClickThree();
		}
		}else{
			bet_3 = player_three_balance;
			$('#bet_3').html(bet_3+"$");
			player_three_balance = 0;
			$('#player_three_balance').html(player_three_balance+"$");
			ClickThree();
			}
		}
});
$('#fold_three').on('click',function(e){
	e.preventDefault();
	$('.img3').hide();
	$('.menu3').hide();	
	if(fold_one !=0){
		$('#ok1').css('display','block');
	}
	fold_three = 0;
	bet_3 = 0
	getStroke();
	$('#bet_3').html(bet_3+"$");
})
$('#check_three').on('click',function(e){
	e.preventDefault();
	if(bet_3 >= bet_1 && bet_3 >= bet_2 || player_three_balance == 0){
		if(bet_3 >=0 ){
		ClickThree();
	$('#player_three_balance').html(player_three_balance+"$");
	$('.bank_view').html(bank+"$");
		}
	}
});


$('#ok2').on('click',function (e) {
	e.preventDefault();
	$('.menu2').show();
	$('.img2').show();
	$('.img_ob2').hide();
	$('#ok2').hide();
});

$('#ok3').on('click',function (e) {
	e.preventDefault();
	$('.menu3').show();
	$('.img3').show();
	$('.img_ob3').hide();
	$('#ok3').hide();
});

$('#ok1').on('click',function (e) {
	e.preventDefault();
	$('.menu1').show();
	$('.img1').show();
	$('.img_ob1').hide();
	$('#ok1').hide();
});

$('#send').on('click',function (e) {
e.preventDefault();
		$.ajax({
		url:'Kart.php',
		data:{player_one_balance:player_one_balance,player_two_balance:player_two_balance,
					player_three_balance:player_three_balance},
		type:'POST',
		dataType:'html',
		cache:false,
		});
});
















































});




//result_total = Number(priceproduct) * Number(data);



















/*
function showBank(bank) {
    $('.bank').html(bank);
}*/

/*
	$('#bet_one').on('click',function (e) {
		//Отменяем переход по ссылке(повидениее поумолчанию-переход по ссылка)
		e.preventDefault();
		var action = $('#bet_one').data('1');
		$.ajax({
		url:'stat.php',
		data:{players_one:'1'},
		type:'POST',
		dataType:'html',
		cache:false,
		 success:function (data) {
		$('.bank').html($(data).closest('.hello'));
        },
		});
	});

});*/
///function(data){ alert ($(data).find("#MyId")) });
//($.data.find("#MyId")) })
//{ alert (data.find("#test1"))
//  $$('result',$$('result').innerHTML+'<br />'+data);closest