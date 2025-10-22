<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1); 
include "header.php";
$user_id = $_SESSION['USER_ID'] ?? '';
if ($user_id == "") {
    header("location: login.php");
}

?>
<br>
<div class="container-fluid">
<div class="container">
<div class='row'>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php
$stmt2 = $db->query("select WALLET from USERS where ID='$user_id';");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $wallet = $row2['WALLET'] ?? '';
}
echo "<div class='single-result'>
<h2>WALLET</h2>
<ul>
<li></li>
<li><a href='transactions.php'><p class='bold-sec'>".number_format($wallet, 2, '.', ',')."</p></a></li>
<li></li>
</ul>
</div>";
?>
    </div>
 
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php
$stmt2 = $db->query("select count(*) as count from BET_TRANSACTIONS where USER_ID='$user_id' and STATUS!='DELETED';");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $game_count = $row2['count'] ?? '';
}
echo "<div class='single-result'>
<h2>MY BETS</h2>
<ul>
<li></li>
<li><a href='bets.php'><p class='bold-sec'>$game_count bets</p></a></li>
<li></li>
</ul>
</div>";
?>
  </div>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class='single-result'>
<h2>WITHDRAW</h2>
<ul>
<li></li>
<li><a href='with_fund.php'><p class='bold-sec'>-</a></li>
<li></li>
</ul>
</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class='single-result'>
<h2>Refer & Earn</h2>
<ul>
<li></li>
<li><a href='refer.php' style='color:black;'><p class='bold-sec'>$$</a></li>
<li></li>
</ul>
</div>
</div>
  
</div>
<br><br><br><br><br><br>
</div>
</div>
<br>
<?php
include "footer.php";
?>
