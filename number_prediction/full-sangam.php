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
}
?>

<style>
.half-sangm-inn {
	display: flex;
	justify-content: space-between;
}
.sing-half label {
	display: block;
	padding: 0 0 10px;
	font-size: 16px;
	color: #000;
}
.sing-half input[type="number"] {
	width: 100%;
	height: 45px;
	border-radius: 4px;
	border: 1px solid #ccc;
	padding: 0 7px;
	-moz-appearance: textfield;
}
.sing-half {
	width: 100%;
	padding: 0 20px 0 0;
}
.dublecate-row i {
	background: #c01b2c;
	color: #fff;
	width: 40px;
	height: 40px;
	text-align: center;
	border-radius: 4px;
	font-size: 20px;
	line-height: 38px;
	cursor: pointer;
}
.fa.fa-minus {
	background: #e5cc4e;
	color: #000;
	display: none;
}
.plmn-btn {
	position: relative;
	top: 32px;
}
.half-sangm-inn {
	margin: 0 0 19px;
}
.half-sangm-one {
	border: 2px solid #ccc;
	border-radius: 10px;
	padding: 24px 30px;
	margin: 0 0 31px;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
</style>

<div class="main-body">

<div class="container-fluid">

<div class="container-fluid">
	<div class="row play-game-area">
		<!-- <div class="container"> -->
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
				
				<div class="all-option">
					<h2>FULL SANGAM (10 KA <?php echo "$f_sangam_price";?>)</h2>
					<h3>Select Your Game</h3>
<font style='color:red;'>
<?php echo $_GET['msg'] ?? '';?>
</font>
					<form action="full_sangam_check.php" method="POST" name="full_sangam_frm" id="full_sangam_frm">
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
						<select name="market" id = "full_sangam_dropdown" required>
							<option value = "" selected>------- Select Market -------</option>
<?php
$stmt1 = $db->query("select ID, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME, DATE_FORMAT(TIME2,'%h:%i %p') as TIME3 from GAMES where PLAY='checked' order by TIME1;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$name=$row1['NAME'] ?? '';
$time1=$row1['TIME'] ?? '';
$time2=$row1['TIME3'] ?? '';
$check_id="";
$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
	$check_id=$row2['ID'] ?? '';
}
if($check_id=="" && ($date=="" || $date==$date1)){
echo "<option disabled value='$id'>$name ($time1)</option>";	
}else{
echo "<option value='$id'>$name ($time1)</option>";	
}
}
?>

				
												</select>
					</div>
					</div>					
					</div>
					
					<div class="half-sangm-one">
						<div class="half-sangm-inn" id="mainObj">
							<div class="sing-half">
								<label>Open Digit</label>
								<input type="number" name="sangam_open[]" min='100' max="999" placeholder="000-999">
							</div>
							<div class="sing-half">
								<label>Close Digit</label>
								<input type="number" name="sangam_close[]" min='100' max="999" placeholder="000-999">
							</div>
							<div class="sing-half">
								<label>Amount</label>
								<input type="number" class="sangam_amount" name="sangam_amount[]" min="10" placeholder="">
							</div>
							<div class="dublecate-row">
								<div class="plmn-btn">
									<i class="fa fa-plus addbtn" aria-hidden="true"></i>
									<i class="fa fa-minus minusbtn" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>




					<h4>total point : <span id="full_sangam_bet">00</span></h4>
					<div class="play-butt"><input class="inp-play-butt" type="submit" value="Submit Game"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php
include "footer.php";
?>
