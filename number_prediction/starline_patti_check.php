<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";
include 'syncwalletbalance.php';
include 'transactionformainwallet.php';
$date=$_POST['date'] ?? '';
$day=date("N", strtotime($date));
$number=$_POST['quantity'] ?? '';
$time=$_POST['single_dropdown'] ?? '';
$check_date=date("Y-m-d");
$id="37";
$open_close="$time";
$hour=date("H",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
if($user_id!=""){
$total=array_sum($number);
$stmt1 = $db->query("select WALLET from USERS where ID='$user_id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
	$wallet=$row1['WALLET'] ?? '';
}
if($wallet >= $total){
if(empty($number)){
	header("location: starline-patti.php?$date=$date&msg=Bet on atleast one number");
}else{
	$check_id="";
	if($time > $hour && $date==$check_date){
		$check_id="Late";
	}
	if(($check_id!="" && $date==$check_date) || $date > $check_date){
		$rand=rand();
		$balance=$wallet;
	foreach ($number as $num => $value) {
    $value = trim($value);
    if (empty($value)){
        echo "$num empty <br/>";
    }else{
		echo "$num,$value <br/>";
        $stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$value','$id','$open_close','$num','','','$rand','$date','Single Patti');";
		$db->query($stmt1);
		$bet_id="";
		$stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='$num';");
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			$bet_id=$row2['ID'] ?? '';
		}
		$balance=$balance - $value;
		if($bet_id!=""){
		$stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$value','$id','$open_close','$balance','$bet_id');";
		$db->query($stmt1);
		$stmt1 = "update USERS set WALLET=WALLET - $value where ID='$user_id'";
		$db->query($stmt1);
				//dedeuct from main balance
				deductFromMain($user_id, $value);
		}
	}
	}
		header("location: starline-patti.php?msg=Bet Accepted");
	}else{
		header("location: starline-patti.php?msg=You are late for this bet");
	}
}
}else{
	header("location: starline-patti.php?msg=Low Balance");
}
}else{
	header("location: login.php");
}
?>
