<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
date_default_timezone_set("Asia/Calcutta");
include "db.php";
include 'syncwalletbalance.php';
include 'transactionformainwallet.php';
$date=$_POST['date'] ?? '';
$time=$_POST['single_dropdown'] ?? '';
$zero=$_POST['zero'] ?? '';
$one=$_POST['one'] ?? '';
$two=$_POST['two'] ?? '';
$three=$_POST['three'] ?? '';
$four=$_POST['four'] ?? '';
$five=$_POST['five'] ?? '';
$six=$_POST['six'] ?? '';
$seven=$_POST['seven'] ?? '';
$eight=$_POST['eight'] ?? '';
$nine=$_POST['nine'] ?? '';
$check_date=date("Y-m-d");
$id="37";
$open_close="$time";
$hour=date("H",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
if($user_id!=""){
$total=$zero + $one + $two + $three + $four + $five + $six + $seven + $eight + $nine;
$stmt1 = $db->query("select WALLET from USERS where ID='$user_id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
	$wallet=$row1['WALLET'] ?? '';
}
if($wallet >= $total){
if($zero=="" && $one=="" && $two=="" && $three=="" && $four=="" && $five=="" && $six=="" && $seven=="" && $eight=="" && $nine==""){
	header("location: starline_single.php?$date=$date&msg=Bet on atleast one number");
}else{
	$check_id="";
	if($time > $hour && $date==$check_date){
		$check_id="Late";
	}
	if(($check_id!="" && $date==$check_date) || $date > $check_date){
		$rand=rand();
		$balance=$wallet;
		if($zero!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$zero','$id','$open_close','0','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='0';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $zero;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$zero','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($one!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$one','$id','$open_close','1','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='1';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $one;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$one','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($two!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$two','$id','$open_close','2','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='2';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $two;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$two','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($three!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$three','$id','$open_close','3','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='3';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $three;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$three','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($four!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$four','$id','$open_close','4','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='4';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $four;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$four','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($five!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$five','$id','$open_close','5','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='5';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $five;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$five','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($six!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$six','$id','$open_close','6','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='6';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $six;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$six','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($seven!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$seven','$id','$open_close','7','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='7';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $seven;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$seven','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($eight!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$eight','$id','$open_close','8','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='8';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $eight;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$eight','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		if($nine!="")
		{		
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$nine','$id','$open_close','9','','','$rand','$date','Single');";
		$db->query($stmt1);
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='9';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $nine;
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$nine','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		}
		$stmt1 = "update USERS set WALLET=WALLET - $total where ID='$user_id'";
		$db->query($stmt1);
		//dedeuct from main balance
		deductFromMain($user_id, $total);

		header("location: starline_single.php?msg=Bet Accepted");
	}else{
		header("location: starline_single.php?msg=You are late for this bet");
	}
}
}else{
	header("location: starline_single.php?msg=Low Balance");
}
}else{
	header("location: login.php");
}
?>