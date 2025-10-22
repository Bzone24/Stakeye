<?php
include "db.php"; 
include 'transactionformainwallet.php';
date_default_timezone_set("Asia/Calcutta");
$stmt2 = $db->query("select STARLINE, STARLINE_SINGLE, STARLINE_DOUBLE from SETTINGS;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$starline_price=$row2['STARLINE'] ?? '';
$starline_patti_price=$row2['STARLINE_SINGLE'] ?? '';
$starline_dpatti_price=$row2['STARLINE_DOUBLE'] ?? '';
}
$starline_price=$starline_price / 10;
$starline_patti_price=$starline_patti_price / 10;
$starline_dpatti_price=$starline_dpatti_price / 10;
$hour=date("H");
$result="";
$game_id="37";
$stmt1 = $db->query("select NAME from GAMES where ID='$game_id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game_name=$row1['NAME'] ?? '';
}
$stmt2 = $db->query("select RESULT from STARLINE where DATE(TIME)=CURDATE() and HOUR(TIME)='$hour';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$result=$row2['RESULT'] ?? '';
$open=$result[0] + $result[1] + $result[2];
$open=substr($open, -1);
}
if($result!=""){
//Single Result Check
$stmt2 = $db->query("select ID, AMOUNT, USER_ID from BET_TRANSACTIONS where GAME_ID='$game_id' and NUMBER='$open' and TYPE='Single' and GAME='$hour' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$win_amount=$amount * $starline_price;
$stmt3="update BET_TRANSACTIONS set RESULT='PASS', WIN_AMOUNT='$win_amount', STATUS='CHECKED' where ID='$bet_id';";
$db->query($stmt3);
$stmt3="update USERS set WALLET=WALLET + $win_amount where ID='$user_id';";
$db->query($stmt3);

	//Add from main balance
    addToMain($user_id, $win_amount);


$stmt3 = $db->query("select NAME, WALLET from USERS where ID='$user_id';");
while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
{
$balance=$row3['WALLET'] ?? '';
$name=$row3['NAME'] ?? '';
}
$name=str_replace("a","X","$name");
$name=str_replace("e","X","$name");
$name=str_replace("i","X","$name");
$name=str_replace("o","X","$name");
$name=str_replace("u","X","$name");
$name=str_replace("b","X","$name");
$name=str_replace("s","X","$name");
$name=str_replace("g","X","$name");
$name=str_replace("A","X","$name");
$name=str_replace("E","X","$name");
$name=str_replace("I","X","$name");
$name=str_replace("O","X","$name");
$name=str_replace("U","X","$name");
$name=str_replace("B","X","$name");
$name=str_replace("S","X","$name");
$name=str_replace("G","X","$name");
$stmt1 = "insert into WINNERS(NAME,AMOUNT,WIN_AMOUNT,GAME,TIME) values ('$name','$amount','$win_amount','$game_name',now());";
$db->query($stmt1);
$stmt3="insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BET_ID,BALANCE,REMARK) values ('$user_id',now(),'$win_amount','$bet_id','$balance','Game Win');";
$db->query($stmt3);
}
$stmt3="update BET_TRANSACTIONS set RESULT='FAIL', STATUS='CHECKED' where GAME_ID='$game_id' and TYPE='Single' and GAME='$hour' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();";
$db->query($stmt3);

//Single Patti Result Check
$stmt2 = $db->query("select ID, AMOUNT, USER_ID from BET_TRANSACTIONS where GAME_ID='$game_id' and NUMBER='$result' and TYPE='Single Patti' and GAME='$hour' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$win_amount=$amount * $starline_patti_price;
$stmt3="update BET_TRANSACTIONS set RESULT='PASS', WIN_AMOUNT='$win_amount', STATUS='CHECKED' where ID='$bet_id';";
$db->query($stmt3);
$stmt3="update USERS set WALLET=WALLET + $win_amount where ID='$user_id';";
$db->query($stmt3);

	//Add from main balance
    addToMain($user_id, $win_amount);

$stmt3 = $db->query("select NAME, WALLET from USERS where ID='$user_id';");
while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
{
$balance=$row3['WALLET'] ?? '';
$name=$row3['NAME'] ?? '';
}
$name=str_replace("a","X","$name");
$name=str_replace("e","X","$name");
$name=str_replace("i","X","$name");
$name=str_replace("o","X","$name");
$name=str_replace("u","X","$name");
$name=str_replace("b","X","$name");
$name=str_replace("s","X","$name");
$name=str_replace("g","X","$name");
$name=str_replace("A","X","$name");
$name=str_replace("E","X","$name");
$name=str_replace("I","X","$name");
$name=str_replace("O","X","$name");
$name=str_replace("U","X","$name");
$name=str_replace("B","X","$name");
$name=str_replace("S","X","$name");
$name=str_replace("G","X","$name");
$stmt1 = "insert into WINNERS(NAME,AMOUNT,WIN_AMOUNT,GAME,TIME) values ('$name','$amount','$win_amount','$game_name',now());";
$db->query($stmt1);
$stmt3="insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BET_ID,BALANCE,REMARK) values ('$user_id',now(),'$win_amount','$bet_id','$balance','Game Win');";
$db->query($stmt3);
}
$stmt3="update BET_TRANSACTIONS set RESULT='FAIL', STATUS='CHECKED' where GAME_ID='$game_id' and TYPE='Single Patti' and GAME='$hour' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();";
$db->query($stmt3);

//Double Patti Result Check
$stmt2 = $db->query("select ID, AMOUNT, USER_ID from BET_TRANSACTIONS where GAME_ID='$game_id' and NUMBER='$result2' and TYPE='Double Patti' and GAME='$hour' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$win_amount=$amount * $starline_dpatti_price;
$stmt3="update BET_TRANSACTIONS set RESULT='PASS', WIN_AMOUNT='$win_amount', STATUS='CHECKED' where ID='$bet_id';";
$db->query($stmt3);
$stmt3="update USERS set WALLET=WALLET + $win_amount where ID='$user_id';";
$db->query($stmt3);
	//Add from main balance
    addToMain($user_id, $win_amount);


$stmt3 = $db->query("select NAME, WALLET from USERS where ID='$user_id';");
while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
{
$balance=$row3['WALLET'] ?? '';
$name=$row3['NAME'] ?? '';
}
$name=str_replace("a","X","$name");
$name=str_replace("e","X","$name");
$name=str_replace("i","X","$name");
$name=str_replace("o","X","$name");
$name=str_replace("u","X","$name");
$name=str_replace("b","X","$name");
$name=str_replace("s","X","$name");
$name=str_replace("g","X","$name");
$name=str_replace("A","X","$name");
$name=str_replace("E","X","$name");
$name=str_replace("I","X","$name");
$name=str_replace("O","X","$name");
$name=str_replace("U","X","$name");
$name=str_replace("B","X","$name");
$name=str_replace("S","X","$name");
$name=str_replace("G","X","$name");
$stmt1 = "insert into WINNERS(NAME,AMOUNT,WIN_AMOUNT,GAME,TIME) values ('$name','$amount','$win_amount','$game_name',now());";
$db->query($stmt1);
$stmt3="insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BET_ID,BALANCE,REMARK) values ('$user_id',now(),'$win_amount','$bet_id','$balance','Game Win');";
$db->query($stmt3);
}
$stmt3="update BET_TRANSACTIONS set RESULT='FAIL', STATUS='CHECKED' where GAME_ID='$game_id' and TYPE='Double Patti' and GAME='$hour' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();";
$db->query($stmt3);
}
?>
