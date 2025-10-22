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
.sing-half input[type="text"] {
    width: 100%;
    height: 45px;
    border-radius: 4px;
    border: 1px solid #ccc;
    padding: 0 7px;
    -moz-appearance: textfield;
}
</style>


<div class="main-body">

<div class="container-fluid">

<div class="container-fluid">
	<div class="row play-game-area">
		<!-- <div class="container"> -->
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
				
				<div class="all-option">
					<h2>HALF SANGAM (10 KA <?php echo "$h_sangam_price";?>)</h2>
					<h3 class="hlf-sang">Select Your Game</h3>
<font style='color:red;'>
<?php echo $_GET['msg'] ?? '';?>
</font>
					<form action="half_sangam_check.php" method="POST" name="half_sangam_frm" id="half_sangam_frm">
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
						<select name = "market" id = "half_sangam_dropdown" required>
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
					
					<!-- Half Sangam Paly Start -->


					<!-- Half section One -->

					<div class="half-sangm-one fObj">
						<div class="half-sangm-inn" id="obj">
							<div class="sing-half">
								<label>Open Ank</label>
								<input type="text" placeholder="0-9" maxlength="1" oninput="if (!window.__cfRLUnblockHandlers) return false; this.value=this.value.replace(/[^0-9]/g,'');" name="sangam_open_ank[]" data-cf-modified-9b4e217d88b2da9d045642a9-="">
							</div>
							<div class="sing-half">
								<label>Close Patti</label>
								<input type="number" placeholder="000-999" min='100' max='999'  oninput="if (!window.__cfRLUnblockHandlers) return false; this.value=this.value.replace(/[^000-999]/g,'');" name="sangam_close_patti[]" data-cf-modified-9b4e217d88b2da9d045642a9-="">
							</div>
							<div class="sing-half">
								<label>Amount</label>
								<input type="number" class="sangam_amount" placeholder="" name="half_sangam_price[]">
							</div>
							<div class="dublecate-row">
								<div class="plmn-btn">
									<i class="fa fa-plus adbtn" aria-hidden="true"></i>
									<i class="fa fa-minus minusbtn" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>



					<!-- Half section Two -->

					<div class="half-sangm-one sObj">
						<div class="half-sangm-inn" id="obj1">
							<div class="sing-half">
								<label>Close Ank</label>
								<input type="text" placeholder="0-9" maxlength="1" oninput="if (!window.__cfRLUnblockHandlers) return false; this.value=this.value.replace(/[^0-9]/g,'');" name="sangam_close_ank[]" data-cf-modified-9b4e217d88b2da9d045642a9-="">
							</div>
							<div class="sing-half">
								<label>Open Patti</label>
								<input type="number" placeholder="000-999" min='100' max='999' maxlength="3" oninput="if (!window.__cfRLUnblockHandlers) return false; this.value=this.value.replace(/[^000-999]/g,'');" name="sangam_open_patti[]" data-cf-modified-9b4e217d88b2da9d045642a9-="">
							</div>
							<div class="sing-half">
								<label>Amount</label>
								<input type="number" class="sangam_amount" placeholder="" name="half_sangam_amount[]">
							</div>
							<div class="dublecate-row">
								<div class="plmn-btn">
									<i class="fa fa-plus smbtn" aria-hidden="true"></i>
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
			<!-- </div> -->
			
			
			
		</div>
	</div>
</div>
</div>


<?php
include "footer.php";
?>
