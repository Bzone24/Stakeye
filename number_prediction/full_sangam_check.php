<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";
include 'syncwalletbalance.php';
include 'transactionformainwallet.php';
$date=$_POST['date'] ?? '';
$id=$_POST['market'] ?? '';
$amount=$_POST['sangam_amount'] ?? '';
$open=$_POST['sangam_open'] ?? '';
$close=$_POST['sangam_close'] ?? '';
$check_date=date("Y-m-d");
if($user_id!=""){
$total=array_sum($amount);
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
if(empty($close) || empty($open)){
	header("location: full-sangam.php?$date=$date&msg=Bet on atleast one number");
}else{
	$check_id="";
	$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE;");
	while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
	{
	$check_id=$row2['ID'] ?? '';
	}
	if(($check_id!="" && $date==$check_date) || $date > $check_date){
		$check_all="";
	foreach ($open as $num => $value) {
		$value = trim($value);
		$close2=$close[$num];
		$amount2=$amount[$num];
		if($value=="" || $close2=="" || $amount2==""){
			$check_all="EMPTY";
		}
	}
		$rand=rand();
		$balance=$wallet;
	if($check_all==""){
foreach ($open as $num => $value) {
    $value = trim($value);
    if (empty($value)){
        echo "$num empty <br/>";
    }else{
		$close1=$close[$num];
		$amount1=$amount[$num];
		$stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE,NUMBER1) values ('$user_id',now(),'$amount1','$id','','$value','','','$rand','$date','Full Sangam','$close1');";
		$db->query($stmt1);
		$bet_id="";
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='$value' and TYPE='Full Sangam';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $amount1;
		if($bet_id!=""){
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$amount1','$id','JODI','$balance','$bet_id');";
		$db->query($stmt1);
		$stmt1 = "update USERS set WALLET=WALLET - $amount1 where ID='$user_id'";
		$db->query($stmt1);
			//dedeuct from main balance
			deductFromMain($user_id, $amount1);
		}
	}
}
	header("location: full-sangam.php?msg=Bet Accepted");
	}else{
	header("location: full-sangam.php?msg=Value can not be empty");	
	}
	}else{
		header("location: full-sangam.php?msg=You are late for this bet");
	}
}
}else{
	header("location: full-sangam.php?msg=Low Balance");
}
}else{
	header("location: login.php");
}
?>
