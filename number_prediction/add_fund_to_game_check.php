<?php
 
session_start();
$user_id = $_SESSION['USER_ID'] ?? '';
include "db.php";
include "maindb.php";
 
$amount = $_POST['amount'] ?? '';

$stmt1 = $db->query("select EMAIL  from USERS where ID =$user_id");
$email = $stmt1->fetchColumn();

//check main wallet balance
$query = "SELECT * FROM users WHERE email = '" . $email . "'";
$stmt = $maindb->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
  
//check balance
if ($result['balance'] >= $amount) {
    //log into main db
    $postBalance = $result['balance'] - $amount;
    $details = 'Fund transfer to satta game';
    $userId = $result['id'];   
    
    
    

// Construct the SQL query using SET syntax
      $sql = "INSERT INTO transactions 
        SET user_id = '$user_id', 
            amount = '$amount', 
            post_balance = '$postBalance', 
            trx_type = '-', 
            trx = NOW(), 
            details = '$details', 
            remark = 'Fund transfer to satta game', 
            type = 'USER_TRANSFER_OUT',
            created_at = '".date('Y-m-d H:i:s')."'";
 
        // Execute the query
    if ($maindb->query($sql)) {
        //Deduct balance from main account
        $sql2 = "update users set balance=$postBalance where id='$userId'";
        $maindb->query($sql2);

        //log into local db
        $stmt1 = "update USERS set WALLET=WALLET + $amount where ID='$user_id'";
        $db->query($stmt1);
        $stmt1 = $db->query("select WALLET  from USERS where ID =$user_id");
        $wallet = $stmt1->fetchColumn();

        $stmt1 = "insert into TRANSACTIONS 
        SET USER_ID = $user_id, 
            AMOUNT = $amount, 
            BALANCE = $wallet, 
            DATE_TIME = NOW(), 
            REMARK = 'Fund added from main wallet' ";

        $db->query($stmt1); 
       
        header("location: add_fund_to_game.php?msg=Wallet transfer completed successfully");

    } else {
        header("location: add_fund_to_game.php?msg=Unable to process your request,Please try after sometime");
    }
} else {
    header("location: add_fund_to_game.php?msg=Unable to process your request, due insufficient balance");
}
