<?php
 
session_start();
$user_id = $_SESSION['USER_ID'] ?? '';
include "db.php";
include 'syncwalletbalance.php';
include 'transactionformainwallet.php';
$date = $_POST['date'] ?? '';
$day = date("N", strtotime($date));
$id = $_POST['market'] ?? '';
$number = $_POST['quantity'] ?? '';
$check_date = date("Y-m-d");
if ($user_id != "") {
    $total = $number;
    $stmt1 = $db->query("select WALLET from USERS where ID='$user_id';");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $wallet = $row1['WALLET'] ?? '';
    }
    $with_amount = 0;
    $stmt2 = $db->query("select  SUM(AMOUNT) as AMOUNT from WITHDRAW where USER_ID='$user_id' and STATUS is NULL;");
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $with_amount = $row2['AMOUNT'] ?? '';
    }
    $wallet = intval($wallet) - intval($with_amount);
    if ($wallet >= $total) {
        if (empty($number)) {
            header("location: jodi.php?$date=$date&msg=Bet on atleast one number");
        } else {
            $check_id = "";
            $closing_time = "";
            $stmt1 = $db->query("select ID, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME, CLOSING_TIME from GAMES where PLAY='checked' AND   ID='$id' order by TIME1;");
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                $closing_time = $row1['CLOSING_TIME'] ?? '';
            }
            $stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL $closing_time MINUTE  and DAYS >= $day;");
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $check_id = $row2['ID'] ?? '';
            }
            if (($check_id != "" && $date == $check_date) || $date > $check_date) {
                $rand = rand();
                $balance = $wallet;
                $value = intval($number);
                $num =  $_POST['numbers'];
                $stmt1 = "insert into BET_TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,NUMBER,STATUS,RESULT,RAND,DATE,TYPE) values ('$user_id',now(),'$value','$id','CROSS','$num','','','$rand','$date','Cross');";
                $db->query($stmt1);
                $bet_id = "";
                $stmt2 = $db->query("select ID from BET_TRANSACTIONS where USER_ID='$user_id' and RAND='$rand' and GAME_ID='$id' and NUMBER='$num';");
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $bet_id = $row2['ID'] ?? '';
                }
                $balance = $balance - $value;
                if ($bet_id != "") {
                    $stmt1 = "insert into TRANSACTIONS (USER_ID,DATE_TIME,AMOUNT,GAME_ID,GAME,BALANCE,BET_ID) values ('$user_id',now(),'$value','$id','JODI','$balance','$bet_id');";
                    $db->query($stmt1);
                    $stmt1 = "update USERS set WALLET=WALLET - $value where ID='$user_id'";
                    $db->query($stmt1);
                    //dedeuct from main balance
                    deductFromMain($user_id, $value);
                }
                header("location: cross.php?success=Bet Accepted");
            } else {
                header("location: cross.php?msg=You are late for this bet");
            }
        }
    } else {
        header("location: cross.php?msg=Low Balance");
    }
} else {
    header("location: login.php");
}
