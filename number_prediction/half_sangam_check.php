<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";
include 'syncwalletbalance.php';
include 'transactionformainwallet.php';
$date=$_POST['date'] ?? '';
$id=$_POST['market'] ?? '';
$half_sangam_price=$_POST['half_sangam_price'] ?? '';
$sangam_close_patti=$_POST['sangam_close_patti'] ?? '';
$sangam_open_ank=$_POST['sangam_open_ank'] ?? '';
$sangam_close_ank=$_POST['sangam_close_ank'] ?? '';
$sangam_open_patti=$_POST['sangam_open_patti'] ?? '';
$half_sangam_amount=$_POST['half_sangam_amount'] ?? '';
$check_date=date("Y-m-d");
$check_bet="";
$check_bet1="";
if($user_id!=""){
$total1=array_sum($half_sangam_price);
$total2=array_sum($half_sangam_amount);
$total=$total1 + $total2;
$stmt1 = $db->query("select WALLET from USERS where ID='$user_id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
	$wallet=$row1['WALLET'] ?? '';
}
$with_amount=0;
$stmt2 = $db->query("select  SUM(AMOUNT) as AMOUNT from WITHDRAW where USER_ID='$user_id' and STATUS is NULL;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$with_amount=$row2['AMOUNT'] ?? '';
}
$wallet=$wallet - $with_amount;
if($wallet >= $total){
if(empty($sangam_open_ank) && empty($sangam_close_ank) && empty($sangam_open_patti) && empty($sangam_close_patti)){
	header("location: half-sangam.php?$date=$date&msg=Bet on atleast one number");
}else{
	$check_id="";
	$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE;");
	while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
	{
	$check_id=$row2['ID'] ?? '';
	}
	if(($check_id!="" && $date==$check_date) || $date > $check_date){
		$rand=rand();
		$balance=$wallet;

foreach ($sangam_open_patti as $num => $value) {
    $value = trim($value);
    if (empty($value)){
        echo "$num empty <br/>";
    }else{
		$sangam_close_ank1=$sangam_close_ank[$num];
		$half_sangam_amount1=$half_sangam_amount[$num];
		if($half_sangam_amount1!="" && $sangam_close_ank1!=""){
			$check_bet="YES";
		}else{
			$check_bet="";
			$check_bet1="ERROR";
		}
	}
}
foreach ($sangam_close_patti as $num => $value) {
    $value = trim($value);
    if (empty($value)){
        echo "$num empty <br/>";
    }else{
		$sangam_open_ank1=$sangam_open_ank[$num];
		$half_sangam_price1=$half_sangam_price[$num];
		if($sangam_open_ank1!="" && $half_sangam_price1!=""){
			$check_bet="YES";
		}else{
			$check_bet="";
			$check_bet1="ERROR";
		}
		}
	}

		
if($check_bet=="YES" && $check_bet1==""){
foreach ($sangam_open_patti as $num => $value) {
    $value = trim($value);
    if (empty($value)){
        echo "$num empty <br/>";
    }else{
		$sangam_close_ank1=$sangam_close_ank[$num];
		$half_sangam_amount1=$half_sangam_amount[$num];
		if($half_sangam_amount1!="" && $sangam_close_ank1!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE,NUMBER1) values ('$user_id',now(),'$half_sangam_amount1','$id','open','$value','','','$rand','$date','Half Sangam','$sangam_close_ank1');";
		$db->query($stmt1);
		$bet_id="";
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='$value' and NUMBER1='$sangam_close_ank1' and TYPE='Half Sangam';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $half_sangam_amount1;
		if($bet_id!=""){
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$half_sangam_amount1','$id','open','$balance','$bet_id');";
		$db->query($stmt1);
		$stmt1 = "update USERS set WALLET=WALLET - $half_sangam_amount1 where ID='$user_id'";
		$db->query($stmt1);
		//dedeuct from main balance
		deductFromMain($user_id, $half_sangam_amount1);
		}
		}
	}
}

foreach ($sangam_close_patti as $num => $value) {
    $value = trim($value);
    if (empty($value)){
        echo "$num empty <br/>";
    }else{
		$sangam_open_ank1=$sangam_open_ank[$num];
		$half_sangam_price1=$half_sangam_price[$num];
		if($sangam_open_ank1!="" && $half_sangam_price1!=""){
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE,NUMBER1) values ('$user_id',now(),'$half_sangam_price1','$id','close','$value','','','$rand','$date','Half Sangam','$sangam_open_ank1');";
		$db->query($stmt1);
		$bet_id="";
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='$value' and TYPE='Half Sangam';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $half_sangam_price1;
		if($bet_id!=""){
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$half_sangam_price1','$id','close','$balance','$bet_id');";
		$db->query($stmt1);
		$stmt1 = "update USERS set WALLET=WALLET - $half_sangam_price1 where ID='$user_id'";
		$db->query($stmt1);
			//dedeuct from main balance
			deductFromMain($user_id, $half_sangam_price1);
		}
		}
	}
}
}
	if($check_bet=="YES" && $check_bet1==""){
	header("location: half-sangam.php?msg=Bet Accepted");
	}else{
	header("location: half-sangam.php?msg=Value can not be empty");	
	}
	}else{
		header("location: half-sangam.php?msg=You are late for this bet");
	}
}
}else{
	header("location: half-sangam.php?msg=Low Balance");
}
}else{
	header("location: login.php");
}
?>
