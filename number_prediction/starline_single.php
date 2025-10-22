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
$hour=date("H",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
$holiday="NO";
?>

<div class="main-body">
<div class="container-fluid">
<div class="container-fluid">
<div class="row play-game-area">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
<div class="all-option">
<h2>STARLINE SINGLE (10 KA <?php echo $starline_price;?>)</h2>
<h3>Play Your Game</h3>
<font style='color:red;'>
<?php echo $_GET['msg'] ?? '';?>
</font>
<form action="starline_single_check.php" method="POST" name="single_frm">
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
if($date!=$date2){
?>
<option value="<?php echo $date2;?>"><?php echo $date2_1;?></option>
<?php
}
if($date!=$date3){
?>
<option value="<?php echo $date3;?>"><?php echo $date3_1;?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
<div class="sele-area">
<select name="single_dropdown" id="single_dropdown" required>
<option value="" disabled selected>------- Select Time -------</option>
<?php
if($holiday=="NO"){
if($date=="" || $date==$date1){
	for ($x=$hour; $x<=21; $x++){
		$y=$x+1;
		if($x == "9"){
			echo "<option value='$y'>$y AM</option>";
		}
		if($x == "10"){
			echo "<option value='$y'>$y AM</option>";
		}
		if($x >= "11"){
			if($y == "12"){
				echo "<option value='$y'>$y PM</option>";
			}else{
				$z=$y - 12;
				echo "<option value='$y'>$z PM</option>";
			}
		}
	}

}else{
echo "<option value='10'>10 AM</option>";
echo "<option value='11'>11 AM</option>";
echo "<option value='12'>12 PM</option>";
echo "<option value='13'>1 PM</option>";
echo "<option value='14'>2 PM</option>";
echo "<option value='15'>3 PM</option>";
echo "<option value='16'>4 PM</option>";
echo "<option value='17'>5 PM</option>";
echo "<option value='18'>6 PM</option>";
echo "<option value='19'>7 PM</option>";
echo "<option value='20'>8 PM</option>";
echo "<option value='21'>9 PM</option>";
echo "<option value='22'>10 PM</option>";
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