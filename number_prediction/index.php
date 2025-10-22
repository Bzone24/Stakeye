<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Number Predition</title>
<meta name="description" content="No1 Trusted Website to Play Matka Online,
satta matka play website, matka satta, sattamatka143, matka result, matka tips,
mumbai tips matka, tips kalyan, bazar satta. Register For Free to Online Matka Play,
Kalyan Matka, Mumbai Matka and More.">
<meta name="keywords" content="online matka, matka online, online matka play, matka play, online satta matka, satta matka online, satta online play">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1.0, minimum-scale=1.0, maximum-scale=1.0">
</head>

<?php

include "header.php";
include "db.php";
?>

<div class="gold-banner owl-carousel owl-theme owl-loaded owl-drag">
<div>
<img src="assets/front/images/banner1.png" alt="Online Matka Play Banner" style='height:200px;'/>
</div>
</div>


<div class="container-fluid" style="background: #181818;">
<div class="container">
<div class="row">
<div class="phone-num">
<h2 class="white-text"><b>Play Number Predition Game</b></h2>
<h2 class="white-text"><b>#1 Most Trusted Number Predition Game</b></h2>
<a href="tel:<?php echo $admin_mobile; ?>"> <span><?php echo $admin_mobile; ?></span></a>
</div>
<hr>
<p style="color:white"><?php echo $domain; ?> is the best preferred platforms to play online Number Predition Game. 
   Contact  us on the telegram icon to know more.</p>
</div>
</div>
</div>
<!--<div class="container-fluid">-->
<!--<div class="row how-play-area">-->
<!--<div class="container">-->

<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--<div class="how-left">-->
<!--<h2>Wallet</h2><hr /> -->
<!--<p>USD <?php echo floatval($wallet_amount); ?></p>-->
 
<!--</p>-->
<!--</div>-->
<!--</div> -->
<!--</div>-->
<!--</div>-->






<!--<div class="row how-play-area">-->
<!--<div class="container">-->



<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--<div class="how-left">-->
<!--<h2>Notice Board</h2><hr />-->
<!--<p><p>BEST&nbsp;<strong>Number Predition Game</strong>&nbsp; WEBSITE.</p>-->
<!--<p>MINIMUM DEPOSIT:-500</p>-->
<!--<p>MINIMUM WITHDRAWAL:-1000</p>-->
<!--<p>MAXIMUM WITHDRAWAL:-NO LIMITS</p>-->
<!--</p>-->
<!--</div>-->
<!--</div>-->





<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--<div class="how-right">-->
<!--<h2>Points Earn </h2>-->
<!--<ul>-->
<!--<li><p><i class="fa fa-hand-o-right" aria-hidden="true"></i> INSIDE - OUSIDE (HARUF) <span>10 Into <?php echo $single_price; ?></span></p></li>-->
<!--<li><p><i class="fa fa-hand-o-right" aria-hidden="true"></i> NUMBERS (J) <span>10 Into <?php echo $jodi_price; ?></span></p></li>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<?php
if ($app_name != "") {
    ?>
<div class="container-fluid blue-background">
<div class="container">
<div class="row offer-area">
<h1>Download App</h1>

<p class="text-center white-text"> Download our attractive online Number Predition Game app and play your game to win huge amounts! <a href="<?php echo $app_name; ?>">Click here</a> to download.</p>
</div>
</div>
</div>
    <?php
}
?>
<div class="container-fluid" style="padding-top:3%">
<div class="container">
<div class="title"><h2 class="heading white-text">Number Predition Game Results</h2></div>
<?php
$days = date('N');
$stmt1 = $db->query("select ID, HOLIDAY, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME, PAGE, HIGHLIGHT from GAMES where PLAY='checked' order by TIME1;");
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $id = $row1['ID'] ?? '';
    $game = $row1['NAME'] ?? '';
    $time1 = $row1['TIME'] ?? '';
    $page = $row1['PAGE'] ?? '';
    $highlight = $row1['HIGHLIGHT'] ?? '';
    $holiday = $row1['HOLIDAY'] ?? '';
    $result1 = "";
    $text = "";
    $text2 = "";
    $stmt2 = $db->query("select RESULT1 from RESULT where GAME_ID='$id' and DATE=CURDATE();");
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $result1 = $row2['RESULT1'] ?? '';
        $result2 = $row2['RESULT2'] ?? '';
        $text = $row2['REMARK'] ?? '';
        $text2 = $row2['REMARK2'] ?? '';
    }
    
    
    
    
    
    if ($result1 == "" && $holiday != "") {
        $text = "Holiday";
    }
    
    
    /*
    
    if ($result1 == "" && $holiday == "") {
        $stmt2 = $db->query("select DAYS from GAMES where ID='$id';");
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $days_check = $row2['DAYS'] ?? '';
        }
        $day = $days_check - $days;
        $day1 = $day;
        if ($day < 0) {
            $day = $day * -1;
        } else {
            if ($days == "1") {
                if ($days_check <= 6) {
                    $day = 8 - $days_check;
                } else {
                    $day = "1";
                }
            } else {
                $day = "1";
            }
        }
    
        if ($day1 >= 0) {
            $stmt2 = $db->query("select RESULT1, REMARK from RESULT where GAME_ID IN (select ID from GAMES where TIME1 > now() + INTERVAL 20 MINUTE and ID='$id') and DATE=CURDATE() - INTERVAL $day DAY;");
        } else {
            $stmt2 = $db->query("select RESULT1, REMARK from RESULT where GAME_ID='$id' and DATE=CURDATE() - INTERVAL $day DAY;");
        }
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $result1 = $row2['RESULT1'] ?? '';
        }
    }*/
    if ($result1 == "") {
        $result1 = "Loading..";
    }
    //last day :  

     $stmt22 = $db->query("select RESULT1, REMARK from RESULT where GAME_ID='$id' and DATE=DATE_SUB(CURDATE(), INTERVAL 1 DAY)  LIMIT 1;");
     $row22 = $stmt22->fetch(PDO::FETCH_ASSOC);
 
     $oldResult = $row22['RESULT1']??'--';

    
    echo "
<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
<div class='single-result'>
<h2><span class='left-time'>$time1</span>$game</h2>
<ul><li>";
    if ($holiday == "") {
        echo "<li><p class='bold-sec' style='color:green'>Today<br/>$result1</p></li>";
        
    } else {
        echo "<li><p class='bold-sec'>Holiday</p></li>";
    }
    echo "
    <p style='color: black;font-weight: 500;background: yellow;text-align: center;font-size: 30px;'>Yesterday : $oldResult</p>
</ul>
</div>
</div>";
}
?>
</div>
</div>
</div>

<!--<div class="container-fluid blue-background">-->
<!--<div class="container">-->
<!--<div class="row gold-cont">-->
<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
<!--<div class="gcon-area">-->
<!--<h2>Number Predition Game Play Online</h2>-->
<!--<p>Contact on telegram for Play Number Predition Game</p>-->
<!--<h3><i class="fa fa-phone" aria-hidden="true"></i>  <?php echo $admin_mobile; ?>-->
<!--</h3>-->
<!--<hr>-->
<!--</div>-->
<!--</div>-->
<!--<p class="text-center white-text">Get Lucky and and Play the Number Predition Game with the most minimum amount. We give you expert to suggestions so that you can full fill your dreams with your own luck. Play Number Predition Game Today!</p>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->


<div class="container-fluid" style="padding-top:5%">
<div class="container">




<?php /*?>



<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-time">
<div class="g-jchat">
<h2>Today's Winner</h2>
<?php
$stmt2 = $db->query("select NAME, GAME, AMOUNT, WIN_AMOUNT, DATE_FORMAT(TIME, '%H:%i') as TIME from WINNERS order by TIME limit 5;");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $u_name = $row2['NAME'] ?? '';
    $time = $row2['TIME'] ?? '';
    $amount = $row2['AMOUNT'] ?? '';
    $win_amount = $row2['WIN_AMOUNT'] ?? '';
    $game = $row2['GAME'] ?? '';
    echo "<a><b>$u_name</b> won <b>₹$win_amount</b> in $game with ₹$amount bet<span>$time</span></a>";
}
?>
</div>
</div>
</div>
<br><br>









<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-time">
<div class="g-jchat">
<h2>Latest Payments</h2>
</div>
</div>
<?php
$stmt2 = $db->query("select NAME, DATE_FORMAT(DATE, '%d/%m/%Y') as DATE, AMOUNT, MODE from PAYMENTS order by DATE limit 6;");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $u_name = $row2['NAME'] ?? '';
    $date = $row2['DATE'] ?? '';
    $amount = $row2['AMOUNT'] ?? '';
    $mode = $row2['MODE'] ?? '';
    echo "
<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
<div class='single-result'>
<h2><span class='left-time'></span>$u_name <span></span></h2>
<ul>
<li><p style='font-size:12px;'>$date</p></li>
<li><p class='bold-sec'>$amount</p></li>
<li><p style='font-size:12px;'>$mode</p></li>
</ul>
</div>
</div>";
}
?>
</div>









<br><br>
<?php
if ($guess == "" || $guess == "YES") {
    ?>
    
    
    
    
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-time">
<div class="win-left">
<h2>Today's Prediction <span><i class="fa fa-user-secret" aria-hidden="true"></i></span></h2>
<div class="time-table">
<table>
<tr>
<th>Market</th>
<th>Inside (A)</th>
<th>Outside (B)</th>
<th>Numbers (J)</th>
</tr>
    <?php
    $stmt2 = $db->query("select ID, NAME from GAMES;");
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $game_id = $row2['ID'] ?? '';
        $game_name = $row2['NAME'] ?? '';
        $open1 = "";
        $open2 = "";
        $open3 = "";
        $open4 = "";
        $jodi1 = "";
        $jodi2 = "";
        $jodi3 = "";
        $jodi4 = "";
        $jodi5 = "";
        $jodi6 = "";
        $jodi7 = "";
        $jodi8 = "";
        $patti1 = "";
        $patti2 = "";
        $patti3 = "";
        $patti4 = "";
        $stmt1 = $db->query("select FIRST, SECOND, THIRD, FORTH from FREE_GAME where WHICH_ONE='OPEN' and GAME_ID='$game_id';");
        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $open1 = $row1['FIRST'] ?? '';
            $open2 = $row1['SECOND'] ?? '';
            $open3 = $row1['THIRD'] ?? '';
            $open4 = $row1['FORTH'] ?? '';
        }
        $stmt1 = $db->query("select FIRST, SECOND, THIRD, FORTH from FREE_GAME where WHICH_ONE='JODI' and GAME_ID='$game_id';");
        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $jodi1 = $row1['FIRST'] ?? '';
            $jodi2 = $row1['SECOND'] ?? '';
            $jodi3 = $row1['THIRD'] ?? '';
            $jodi4 = $row1['FORTH'] ?? '';
        }
        $stmt1 = $db->query("select FIRST, SECOND, THIRD, FORTH from FREE_GAME where WHICH_ONE='PATTI' and GAME_ID='$game_id';");
        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $patti1 = $row1['FIRST'] ?? '';
            $patti2 = $row1['SECOND'] ?? '';
            $patti3 = $row1['THIRD'] ?? '';
            $patti4 = $row1['FORTH'] ?? '';
        }
        echo "<tr>
<td>$game_name</td>
<td>$open1, $open2, $open3, $open4</td>
<td>$patti1, $patti2, $patti3, $patti4</td>
<td>$jodi1, $jodi2, $jodi3, $jodi4</td
</tr>";
    }
    ?>
</table>
</div>
</div>
</div>
</div>
<br>
    <?php
}
?>

<?php */?>








<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-time">
<div class="win-left">
<h2>Number Predition Game Time Table <span><i class="fa fa-clock-o" aria-hidden="true"></i></span></h2>
<div class="time-table">
<table>
<tr>
<th>Market</th>
<th>Time</th>
</tr>
<?php
$stmt1 = $db->query("select NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME from GAMES where PLAY='checked' order by TIME1;");
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $name = $row1['NAME'] ?? '';
    $time1 = $row1['TIME'] ?? '';
    echo "<tr>
<td>$name</td>
<td>$time1</td>
</tr>";
}
?>
</table>
</div>
</div>
</div>
</div>




<br/>

 



<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-time">
<div class="win-left">
<h2>Previous Result(s)<span><i class="fa fa-clock-o" aria-hidden="true"></i></span></h2>
<div class="time-table">
<table>
    <tr><td>Date</td>
<?php
$gameIdArr = array();
$gameStat = $db->query("select NAME, ID from GAMES");
while ($gameData = $gameStat->fetch(PDO::FETCH_ASSOC)) {

$gameName = $gameData['NAME']??'';
 $gameIdArr[] = $gameData['ID'];
?>


<td><?php echo $gameName;?></td>



<?php
    
}
?>
</tr>

<tr>
    
<?php
$yesterday = date('Y-m-d', strtotime('-1 day'));

$lastDate =  date('Y-m-d', strtotime('-8 day'));
// Convert dates to timestamps for comparison
$currentTimestamp = strtotime($yesterday);
$endTimestamp = strtotime($lastDate);
 
 $count = count($gameIdArr);

// Loop through the dates
while ($currentTimestamp >= $endTimestamp) {
    $nowDate = date('Y-m-d', $currentTimestamp);
    
    echo "<tr>"; // Start a new row for the date
    echo "<td>" . $nowDate . "</td>"; // Print the current date
    
    for ($i = 0; $i < $count; $i++) { // Corrected condition: $i < $count
        echo "<td>";
        
        // Prepare query for the current game and date
        $query = "SELECT GAME_ID, RESULT1 FROM RESULT WHERE GAME_ID = '{$gameIdArr[$i]}' AND date = '$nowDate' LIMIT 1";
        $result = $db->query($query); 
        $data = $result->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo $data['RESULT1']; // Print result
        } else {
            echo "--"; // Placeholder if no result found
        }

        echo "</td>";
    }
      echo "</tr>"; 
 $currentTimestamp = strtotime('-1 day', $currentTimestamp);
}
 

?>

</tr>



 
</table>
</div>
</div>
</div>
</div>
</div>
</div>




























<div class="container-fluid">
<div class="container">
<div class="row gold-jchat">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="g-jchat">
<h2>Old Record Charts</h2>
<?php
$stmt1 = $db->query("select NAME, PAGE from GAMES where PLAY='checked' order by TIME1;");
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $name = $row1['NAME'] ?? '';
    $page = $row1['PAGE'] ?? '';
    echo "<a href='https://bhagirathexp.in/index.php?game_name=$page'>$name<span><i class='fa fa-paper-plane' aria-hidden='true'></i></span></a>";
}
?>
</div>
</div>
</div>
</div>
</div>
<!-- <div class="container-fluid">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3 class="heading">Online Satta King Matka</h3>
<p>Live results on all the online satta king matka play markets, every day on Matka Play</p>
<p>Here at MatkaPlay we don't like matka, we love it. Our consistant aim to match your obsession and passion for the game by bringing the best in online matka, from kalyan and other major houses. We cover almost all the major matka play markets including rajdhani, kalyan, main ratan and navratna.</p>
<p>There are other markets that are also avialable along side the above mentioned, across dozens of others. All these can be accessed through our web application matkaplay, Meaning you can easily bid weather you are at home or busy with some other work. </p>
</div>
</div>
</div>
</div>
<div class="container-fluid">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3 class="heading">Satta King Matka Play</h3>
<p>The exact orgins of matka re unknown, but historians belive that matka originated from india and was played informally amount communities and villages. With the origin and birth home of matka being right here in india. We brign exponential knowledge in online matka playing.</p>
<p>With our knowledge in the matka game, you will find every feature in our application useful and helpful. Providing competitive rates and the best user experience to our users has been the main goal all along.</p>
</div>
</div>
</div>
</div> -->
<!--<div class="container-fluid">-->
<!--<div class="container">-->
<!--<div class="row">-->
<!--<div class="col-md-12">-->
<!--<h3 class="heading">Why Choose Us</h3>-->
<!--<p>We gladly would appretiate that there are a lot of Number Predition Game play sites out there, but we strongly trust that <?php echo $domain; ?> stands out from the rest.</p>-->
<!--<p>We offer a unique platform and this is our fundamental offering. Our platfrom is mobile and user friendly. Hence, navigating through our website is as easy as learning numerics. We offer an online matka play app what works on both android and ios platforms. </p>-->
<!--<p>Our fantastic website serves various range of Number Predition play markets and games that are backed by the best Number Predition Game owners. along with insider news and special offers we are an all in one games destination.</p>-->
<!--<p>Are you interested in the thrill of Number Predition Game, at Number Predition Game play we offer various online matka play classics such as <a href="andar.php">Andar</a>, <a href="jodi.php">jodi</a> and <a href="bahar.php">Bahar</a>. All these online games are new to <a href="index.php">online Number Predition Game play</a>.</p>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

<?php
include "footer.php";
?>
