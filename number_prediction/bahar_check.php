<?php

/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);*/

session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";

include 'syncwalletbalance.php';
include 'transactionformainwallet.php';

$date=$_POST['date'] ?? '';
$day=date("N", strtotime($date));
$market=$_POST['single_dropdown'] ?? '';

$zero = (float) ($_POST['zero'] ?? "");
$one = (float) ($_POST['one'] ?? "");
$two = (float) ($_POST['two'] ?? "");
$three = (float) ($_POST['three'] ?? "");
$four = (float) ($_POST['four'] ?? "");
$five = (float) ($_POST['five'] ?? "");
$six = (float) ($_POST['six'] ?? "");
$seven = (float) ($_POST['seven'] ??"");
$eight = (float) ($_POST['eight'] ?? "");
$nine = (float) ($_POST['nine'] ?? "");


$arr = explode("-", $market);

$arr = array_splice($arr, 0, 1);



$open_close = implode("-", $arr);


$arr = explode("-", $market);

$arr = array_splice($arr, 1, 2);

$id = implode( "-",$arr); 
$check_date=date("Y-m-d"); 

if($user_id!=""){
	$total= (float) $zero + (float) $one + (float) $two + (float) $three + (float) $four + (float) $five + (float) $six + (float) $seven + (float) $eight + (float) $nine;
$stmt1 = $db->query("select WALLET from USERS where ID='$user_id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
	$wallet=$row1['WALLET'] ?? '';
}
$with_amount=0;
$stmt2 = $db->query("select  SUM(AMOUNT) as AMOUNT from WITHDRAW where USER_ID='$user_id' and STATUS is NULL;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$with_amount=  (float) $row2['AMOUNT'] ?? '';
}
$wallet=$wallet - $with_amount;
if($wallet >= $total){
if(empty($total)){
	header("location: bahar.php?$date=$date&msg=Bet on atleast one number");
}else{
	$check_id="";
	if($open_close=="open"){
		$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE and DAYS >= $day;");
	}else{
		if($id=="14000000000"){
			$stmt2 = $db->query("select ID from GAMES where ID='$id' and '23:55:00' > CURTIME() + INTERVAL 10 MINUTE and DAYS >= $day;");	
		}else{
			$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE and DAYS >= $day;");
		}
	}
	while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
	{
	$check_id=$row2['ID'] ?? '';
	}
	if(($check_id!="" && $date==$check_date) || $date > $check_date){
		$rand=rand();
		$balance=$wallet;
		if(!empty($zero)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$zero','$id','$open_close','0','','','$rand','$date','Bahar');";
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
		if(!empty($one)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$one','$id','$open_close','1','','','$rand','$date','Bahar');";
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
		if(!empty($two)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$two','$id','$open_close','2','','','$rand','$date','Bahar');";
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
		if(!empty($three)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$three','$id','$open_close','3','','','$rand','$date','Bahar');";
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
		if(!empty($four)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$four','$id','$open_close','4','','','$rand','$date','Bahar');";
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
		if(!empty($five)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$five','$id','$open_close','5','','','$rand','$date','Bahar');";
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
		if(!empty($six)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$six','$id','$open_close','6','','','$rand','$date','Bahar');";
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
		if(!empty($seven)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$seven','$id','$open_close','7','','','$rand','$date','Bahar');";
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
		if(!empty($eight)){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$eight','$id','$open_close','8','','','$rand','$date','Bahar');";
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
		if(!empty($nine))
		{		
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$nine','$id','$open_close','9','','','$rand','$date','Bahar');";
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

		//dedeuct from main balance
		deductFromMain($user_id, $total);

		$db->query($stmt1);
		header("location: bahar.php?success=Bet Accepted");
	}else{
		header("location: bahar.php?msg=You are late for this bet");
	}
}
}else{
	header("location: bahar.php?msg=Low Balance");
}
}else{
	header("location: login.php");
}
?>
