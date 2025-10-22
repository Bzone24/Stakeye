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


<noscript><meta http-equiv='refresh' content='0; URL=enable-js%3Fjs=0.html'> </noscript>

<div class="main-body">
<div class="container-fluid">
<div class="row play-game-area">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
<div class="all-option2">
<form action="tripple_patti_check.php" method="POST" name="double_patti_frm" id="double_patti_frm">
<h2>TRIPPLE PATTI (10 KA <?php echo $t_patti_price;?>)</h2>
<h3>Select Your Game</h3>
<font style='color:red;'>
<?php echo $_GET['msg'] ?? '';?>
</font>
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
<option value="" disabled selected>------- Select Market -------</option>
<?php
$stmt1 = $db->query("select ID, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME, DATE_FORMAT(TIME2,'%h:%i %p') as TIME3 from GAMES where PLAY='checked' order by TIME1;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$name=$row1['NAME'] ?? '';
$time1=$row1['TIME'] ?? '';
$time2=$row1['TIME3'] ?? '';
$check_id="";
$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE and DAYS >= $day and (HOLIDAY='' or HOLIDAY is NULL);");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
	$check_id=$row2['ID'] ?? '';
}
if($check_id=="" && ($date=="" || $date==$date1)){
echo "<option disabled value='open-$id'>$name OPEN ($time1)</option>";	
}else{
echo "<option value='open-$id'>$name OPEN ($time1)</option>";	
}
$check_id="";
if($id=="1400000000000"){
$stmt2 = $db->query("select ID from GAMES where ID='$id' and '23:55:00' > CURTIME() + INTERVAL 10 MINUTE and DAYS >= $day and (HOLIDAY='' or HOLIDAY is NULL);");	
}else{
$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME2 > now() + INTERVAL 10 MINUTE and DAYS >= $day and (HOLIDAY='' or HOLIDAY is NULL);");
}
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
	$check_id=$row2['ID'] ?? '';
}
if($check_id=="" && ($date=="" || $date==$date1)){
echo "<option disabled value='close-$id'>$name CLOSE ($time2)</option>";
}else{
echo "<option value='close-$id'>$name CLOSE ($time2)</option>";
}
}
?>
</select>
</div>
</div>
</div>

<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">1</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>777</span><input type="number" class="nc-ch double_patti_box" name="quantity[777]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">2</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>444</span><input type="number" class="nc-ch double_patti_box" name="quantity[444]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">3</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>111</span><input type="number" class="nc-ch double_patti_box" name="quantity[111]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">4</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>888</span><input type="number" class="nc-ch double_patti_box" name="quantity[888]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">5</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>555</span><input type="number" class="nc-ch double_patti_box" name="quantity[555]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">6</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>222</span><input type="number" class="nc-ch double_patti_box" name="quantity[222]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">7</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>999</span><input type="number" class="nc-ch double_patti_box" name="quantity[999]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">8</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>666</span><input type="number" class="nc-ch double_patti_box" name="quantity[666]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">9</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>333</span><input type="number" class="nc-ch double_patti_box" name="quantity[333]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #1a774d;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #2d3e4f;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">0</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>0</span><input type="number" class="nc-ch double_patti_box" name="quantity[0]" min="10" /></li>
</ul>
</div>
</div>
<h4>total bet : <span id="double_patti_bet">00</span></h4>
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
