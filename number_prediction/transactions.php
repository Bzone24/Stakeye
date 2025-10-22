<?php

include "header.php";
include "db.php";
$user_id = $_SESSION['USER_ID'] ?? '';
if ($user_id == "") {
    header("location: login.php");
}
?>
<br>
<div class="container-fluid">
<div class="container">
<div class='row'>
    <div class="col-lg-12">
        <div style="float:right;display:none">
            <a class="btn btn-danger"  href="transfer_to_main_wallet.php">Transfer to main wallet</a> &nbsp;
            <a class="btn btn-primary"   href="add_fund_to_game.php">Add Fund</a>
        </div>
    <table class='table'>
  <thead><th>Date</th><th>Market</th><th>Amount</th><th>Balance</th></thead>
 <tbody>
<?php
$stmt1 = $db->query("select DATE_FORMAT(DATE_TIME, '%d/%m/%Y %H:%i') as DATE_TIME, AMOUNT, GAME_ID, GAME, BET_ID, BALANCE, REMARK from TRANSACTIONS where USER_ID='$user_id' order by ID DESC;");
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $amount = $row1['AMOUNT'] ?? '';
    $date = $row1['DATE_TIME'] ?? '';
    $game_id = $row1['GAME_ID'] ?? '';
    $game = $row1['GAME'] ?? '';
    $bet_id = $row1['BET_ID'] ?? '';
    $balance = $row1['BALANCE'] ?? '';
    $remark = $row1['REMARK'] ?? '';
    $game_name = "";
    $remark1 = "";
    $stmt2 = $db->query("select NAME from GAMES where ID='$game_id';");
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $game_name = $row2['NAME'] ?? '';
    }
    if ($game_id == "") {
        $remark1 = "$remark";
    }
    if ($game_id == "37") {
        if ($game < 12) {
            $game = "$game AM";
        }
        if ($game > 12) {
            $game = $game - 12;
            $game = "$game PM";
        }
        if ($game == "12") {
            $game = "$game PM";
        }
    }
    echo "<tr><td>$date</td><td><a href='bets.php?id=$bet_id'>$game_name $game</a>";
    if ($remark == "Bet Deleted" || $remark == "Game Win") {
        echo "<a href='bets.php?id=$bet_id'>$remark</a>";
    } else {
        echo "$remark";
    }
    echo "</td><td>$amount</td><td>$balance</td></tr>";
}
?>
</tbody></table>
   </div>
 

  
</div>
<br><br><br><br><br><br>
</div>
</div>
<br>
<?php
include "footer.php";
?>
