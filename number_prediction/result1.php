<?php
include "db.php"; 
include 'transactionformainwallet.php';
$stmt2 = $db->query("select SINGLE, JODI from SETTINGS;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$single=$row2['SINGLE'] ?? '';
$jodi=$row2['JODI'] ?? '';
}
$single=$single / 10;
$jodi=$jodi / 10;
$day=date("N");
$stmt1 = $db->query("select NAME, ID from GAMES where PLAY='checked' and TIME1 < now() - INTERVAL 10 MINUTE and DAYS>= $day - 1 and (HOLIDAY='' or HOLIDAY is NULL);");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game_id=$row1['ID'] ?? '';
$game_name=$row1['NAME'] ?? '';
echo "Checking for $game_name - $game_id \n <br>";
$result1="";
$stmt2 = $db->query("select RESULT1 from RESULT where GAME_ID='$game_id' and DATE=CURDATE() - INTERVAL 1 DAY;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$result1=$row2['RESULT1'] ?? '';
}
if($result1!=""){
//Andar Result Check
$andar=substr($result1, 0, 1);
$bahar=substr($result1, -1);
echo "$andar - $bahar = $result1 \n <br>";
$stmt2 = $db->query("select ID, AMOUNT, USER_ID from BET_TRANSACTIONS where GAME_ID='$game_id' and NUMBER='$andar' and TYPE='Andar' and GAME='andar' and (STATUS='' or STATUS is NULL) and DATE=CURDATE() - INTERVAL 1 DAY;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$win_amount=$amount * $single;
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
$stmt3="update BET_TRANSACTIONS set RESULT='FAIL', STATUS='CHECKED' where GAME_ID='$game_id' and TYPE='Andar' and GAME='andar' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();";
$db->query($stmt3);

//Bahar Result Check
$stmt2 = $db->query("select ID, AMOUNT, USER_ID from BET_TRANSACTIONS where GAME_ID='$game_id' and NUMBER='$bahar' and TYPE='Bahar' and GAME='bahar' and (STATUS='' or STATUS is NULL) and DATE=CURDATE() - INTERVAL 1 DAY;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$win_amount=$amount * $single;
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
$stmt3="update BET_TRANSACTIONS set RESULT='FAIL', STATUS='CHECKED' where GAME_ID='$game_id' and TYPE='Bahar' and GAME='bahar' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();";
$db->query($stmt3);

//Jodi Result Check
$stmt2 = $db->query("select ID, AMOUNT, USER_ID from BET_TRANSACTIONS where GAME_ID='$game_id' and NUMBER='$result1' and TYPE='Jodi' and GAME='JODI' and (STATUS='' or STATUS is NULL) and DATE=CURDATE() - INTERVAL 1 DAY;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$win_amount=$amount * $jodi;
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
$stmt3="update BET_TRANSACTIONS set RESULT='FAIL', STATUS='CHECKED' where GAME_ID='$game_id' and TYPE='Jodi' and GAME='JODI' and (STATUS='' or STATUS is NULL) and DATE=CURDATE();";
$db->query($stmt3);
echo "Completed\n";
}
}
?>

