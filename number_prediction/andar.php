<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
$date1=date("Y-m-d");
$date1_1=date("d/M/Y");
$date2=date("Y-m-d", strtotime("+1 day"));
$date2_1=date("d/M/Y", strtotime("+1 day"));
$date3=date("Y-m-d", strtotime("+2 day"));
$date3_1=date("d/M/Y", strtotime("+2 day"));
$date=$_GET['date'] ?? '';
if($date!=""){
if($date < $date1){
	$date=$date1;	
}
if($date > $date3){
	$date=$date3;
}
$date_1 = date("d/M/Y", strtotime($date));
$day=date("N", strtotime($date));
}else{
$day=date("N");	
}
?>

<div class="main-body">
<div class="container-fluid">
<div class="container-fluid">
<div class="row play-game-area">
<div class="container">
    
 

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
    <br/>
       <?php if (!empty($_GET['msg'])): ?>
<div class="alert alert-danger">
	<?php echo htmlspecialchars($_GET['msg']); ?>
</div>
<?php endif; ?>

<?php if (!empty($_GET['success'])): ?>
<div class="alert alert-success">
	<?php echo htmlspecialchars($_GET['success']); ?>
</div>
<?php endif; ?>

<div class="all-option">
<h2>INSIDE (A)</h2>
<h3>Select Your Game</h3>


 


<form action="andar_check.php" method="POST" name="single_frm">
<div class="row main-top">
<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
<div class="sele-date-area">
<select name="date" id="bet_date" onchange="window.location='?date='+this.value">
<?php
if($date!=""){
	echo "<option value='$date'>$date_1</option>";	
}
if($date!=$date1){
?>
<option value="<?php echo $date1;?>"><?php echo $date1_1;?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
<div class="sele-area">
<select name="single_dropdown" id="single_dropdown" required>
<option value="" disabled selected>------- Select Market -------</option>
<?php
$stmt1 = $db->query("select ID, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME, CLOSING_TIME from GAMES where PLAY='checked' order by TIME1;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$name=$row1['NAME'] ?? '';
$time1=$row1['TIME'] ?? '';
  $closingTime = $row1['CLOSING_TIME']??10;
$check_id="";
 $db->query("SET time_zone = '+05:30'");
 
$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL ".$closingTime." MINUTE and DAYS >= $day  and (HOLIDAY='' or HOLIDAY is NULL);");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
	$check_id=$row2['ID'] ?? '';
}
if($check_id=="" && ($date=="" || $date==$date1)){
echo "<option disabled value='andar-$id'>$name ($time1)</option>";	
}else{
echo "<option value='andar-$id'>$name ($time1)</option>";	
}
}
?>
</select>
</div>
</div>
</div>
<div class="sing-option">
<div class="sing1 single6">
<ul>
<li><span>0</span><input type="number" class="nc-ch single_box" name="zero" id="n0" min="10" /></li>
<li><span>1</span><input type="number" class="nc-ch single_box" name="one" id="n1" min="10" /></li>
<li><span>2</span><input type="number" class="nc-ch single_box" name="two" id="n2" min="10" /></li>
<li><span>3</span><input type="number" class="nc-ch single_box" name="three" id="n3" min="10" /></li>
<li><span>4</span><input type="number" class="nc-ch single_box" name="four" id="n4" min="10" /></li>
<li><span>5</span><input type="number" class="nc-ch single_box" name="five" id="n5" min="10" /></li>
<li><span>6</span><input type="number" class="nc-ch single_box" name="six" id="n6" min="10" /></li>
<li><span>7</span><input type="number" class="nc-ch single_box" name="seven" id="n7" min="10" /></li>
<li><span>8</span><input type="number" class="nc-ch single_box" name="eight" id="n8" min="10" /></li>
<li><span>9</span><input type="number" class="nc-ch single_box" name="nine" id="n9" min="10" /></li>
</ul>
</div>
</div>
<h4>total point : <span id="single_bet">00</span></h4>
<div class="play-butt"><input type="submit" value="Submit Game"></div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php
include "footer.php";
?>
