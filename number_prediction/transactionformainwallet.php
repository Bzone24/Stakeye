<?php

@session_start();

function deductFromMain($userId, $balance)
{
include "db.php";
include "maindb.php";

    $stmt1 = $db->query("select EMAIL  from USERS where ID =$userId");
    $email = $stmt1->fetchColumn();
    
    //check main wallet balance
    $query = "SELECT * FROM users WHERE email = '" . $email . "'";
    $stmt = $maindb->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $postBalance = $result['balance'] - $balance;
    $details = 'Fund spend at number prediction game';
    $userId = $result['id'];

    $sql = "INSERT INTO transactions 
    SET user_id = '$userId', 
        amount = '$balance', 
        post_balance = '$postBalance', 
        trx_type = '-', 
        trx = NOW(), 
        details = '$details', 
        remark = 'Fund spend at number prediction game', 
        type = 'TYPE_USER_TRANSFER_OUT',
        created_at = '" . date('Y-m-d H:i:s') . "'";
        // Execute the query
        $maindb->query($sql);
        //update in main wallet
        $sql2 = "update users set balance = $postBalance where id='$userId'";
        $maindb->query($sql2);
}
function addToMain($userId, $balance)
{
include "db.php";
include "maindb.php";
    $stmt1 = $db->query("select EMAIL  from USERS where ID =$userId");
    $email = $stmt1->fetchColumn();
    
    //check main wallet balance
    $query = "SELECT * FROM users WHERE email = '" . $email . "'";
    $stmt = $maindb->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $postBalance = $result['balance'] + $balance;
    $details = 'Fund added from number prediction game';
    $userId = $result['id'];

    $sql = "INSERT INTO transactions 
    SET user_id = '$userId', 
        amount = '$balance', 
        post_balance = '$postBalance', 
        trx_type = '+', 
        trx = NOW(), 
        details = '$details', 
        remark = 'Fund added from number prediction game', 
        type = 'TYPE_USER_TRANSFER_IN',
        created_at = '" . date('Y-m-d H:i:s') . "'";
        // Execute the query
        $maindb->query($sql);
        $sql2 = "update users set balance = $postBalance where id='$userId'";
        $maindb->query($sql2);
}
