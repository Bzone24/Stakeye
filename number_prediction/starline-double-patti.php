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
<div class="row play-game-area">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
<div class="all-option2">
<form action="starline-double-patti_check.php" method="POST" name="double_patti_frm" id="double_patti_frm">
<h2>STARLINE DOUBLE PATTI (10 KA <?php echo $starline_dpatti_price;?>)</h2>
<h3>PLAY Your Game</h3>
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

<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">1</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>100</span><input type="number" class="nc-ch double_patti_box" name="quantity[100]" min="10" /></li>

<li class=""><span>119</span><input type="number" class="nc-ch double_patti_box" name="quantity[119]" min="10" /></li>

<li class=""><span>155</span><input type="number" class="nc-ch double_patti_box" name="quantity[155]" min="10" /></li>

<li class=""><span>227</span><input type="number" class="nc-ch double_patti_box" name="quantity[227]" min="10" /></li>

<li class=""><span>335</span><input type="number" class="nc-ch double_patti_box" name="quantity[335]" min="10" /></li>

<li class=""><span>344</span><input type="number" class="nc-ch double_patti_box" name="quantity[344]" min="10" /></li>

<li class=""><span>399</span><input type="number" class="nc-ch double_patti_box" name="quantity[399]" min="10" /></li>

<li class=""><span>588</span><input type="number" class="nc-ch double_patti_box" name="quantity[588]" min="10" /></li>

<li class=""><span>669</span><input type="number" class="nc-ch double_patti_box" name="quantity[669]" min="10" /></li>
</ul>
 </div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">2</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>200</span><input type="number" class="nc-ch double_patti_box" name="quantity[200]" min="10" /></li>

<li class=""><span>110</span><input type="number" class="nc-ch double_patti_box" name="quantity[110]" min="10" /></li>

<li class=""><span>228</span><input type="number" class="nc-ch double_patti_box" name="quantity[228]" min="10" /></li>

<li class=""><span>255</span><input type="number" class="nc-ch double_patti_box" name="quantity[255]" min="10" /></li>

<li class=""><span>336</span><input type="number" class="nc-ch double_patti_box" name="quantity[336]" min="10" /></li>

<li class=""><span>499</span><input type="number" class="nc-ch double_patti_box" name="quantity[499]" min="10" /></li>

<li class=""><span>660</span><input type="number" class="nc-ch double_patti_box" name="quantity[660]" min="10" /></li>

<li class=""><span>688</span><input type="number" class="nc-ch double_patti_box" name="quantity[688]" min="10" /></li>

<li class=""><span>778</span><input type="number" class="nc-ch double_patti_box" name="quantity[778]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">3</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>300</span><input type="number" class="nc-ch double_patti_box" name="quantity[300]" min="10" /></li>

<li class=""><span>166</span><input type="number" class="nc-ch double_patti_box" name="quantity[166]" min="10" /></li>

<li class=""><span>229</span><input type="number" class="nc-ch double_patti_box" name="quantity[229]" min="10" /></li>

<li class=""><span>337</span><input type="number" class="nc-ch double_patti_box" name="quantity[337]" min="10" /></li>

<li class=""><span>355</span><input type="number" class="nc-ch double_patti_box" name="quantity[355]" min="10" /></li>

<li class=""><span>445</span><input type="number" class="nc-ch double_patti_box" name="quantity[445]" min="10" /></li>

<li class=""><span>599</span><input type="number" class="nc-ch double_patti_box" name="quantity[599]" min="10" /></li>

<li class=""><span>779</span><input type="number" class="nc-ch double_patti_box" name="quantity[779]" min="10" /></li>

<li class=""><span>788</span><input type="number" class="nc-ch double_patti_box" name="quantity[788]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">4</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>400</span><input type="number" class="nc-ch double_patti_box" name="quantity[400]" min="10" /></li>

<li class=""><span>112</span><input type="number" class="nc-ch double_patti_box" name="quantity[112]" min="10" /></li>

<li class=""><span>220</span><input type="number" class="nc-ch double_patti_box" name="quantity[220]" min="10" /></li>

<li class=""><span>266</span><input type="number" class="nc-ch double_patti_box" name="quantity[266]" min="10" /></li>

<li class=""><span>338</span><input type="number" class="nc-ch double_patti_box" name="quantity[338]" min="10" /></li>

<li class=""><span>446</span><input type="number" class="nc-ch double_patti_box" name="quantity[446]" min="10" /></li>

<li class=""><span>455</span><input type="number" class="nc-ch double_patti_box" name="quantity[455]" min="10" /></li>

<li class=""><span>699</span><input type="number" class="nc-ch double_patti_box" name="quantity[699]" min="10" /></li>

<li class=""><span>770</span><input type="number" class="nc-ch double_patti_box" name="quantity[770]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">5</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>500</span><input type="number" class="nc-ch double_patti_box" name="quantity[500]" min="10" /></li>

<li class=""><span>113</span><input type="number" class="nc-ch double_patti_box" name="quantity[113]" min="10" /></li>

<li class=""><span>122</span><input type="number" class="nc-ch double_patti_box" name="quantity[122]" min="10" /></li>

<li class=""><span>177</span><input type="number" class="nc-ch double_patti_box" name="quantity[177]" min="10" /></li>

<li class=""><span>339</span><input type="number" class="nc-ch double_patti_box" name="quantity[339]" min="10" /></li>

<li class=""><span>366</span><input type="number" class="nc-ch double_patti_box" name="quantity[366]" min="10" /></li>

<li class=""><span>447</span><input type="number" class="nc-ch double_patti_box" name="quantity[447]" min="10" /></li>

<li class=""><span>799</span><input type="number" class="nc-ch double_patti_box" name="quantity[799]" min="10" /></li>

<li class=""><span>889</span><input type="number" class="nc-ch double_patti_box" name="quantity[889]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">6</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>600</span><input type="number" class="nc-ch double_patti_box" name="quantity[600]" min="10" /></li>

<li class=""><span>114</span><input type="number" class="nc-ch double_patti_box" name="quantity[114]" min="10" /></li>

<li class=""><span>277</span><input type="number" class="nc-ch double_patti_box" name="quantity[277]" min="10" /></li>

<li class=""><span>330</span><input type="number" class="nc-ch double_patti_box" name="quantity[330]" min="10" /></li>

<li class=""><span>448</span><input type="number" class="nc-ch double_patti_box" name="quantity[448]" min="10" /></li>

<li class=""><span>466</span><input type="number" class="nc-ch double_patti_box" name="quantity[466]" min="10" /></li>

<li class=""><span>556</span><input type="number" class="nc-ch double_patti_box" name="quantity[556]" min="10" /></li>

<li class=""><span>880</span><input type="number" class="nc-ch double_patti_box" name="quantity[880]" min="10" /></li>

<li class=""><span>899</span><input type="number" class="nc-ch double_patti_box" name="quantity[899]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">7</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>700</span><input type="number" class="nc-ch double_patti_box" name="quantity[700]" min="10" /></li>

<li class=""><span>115</span><input type="number" class="nc-ch double_patti_box" name="quantity[115]" min="10" /></li>

<li class=""><span>133</span><input type="number" class="nc-ch double_patti_box" name="quantity[133]" min="10" /></li>

<li class=""><span>188</span><input type="number" class="nc-ch double_patti_box" name="quantity[188]" min="10" /></li>

<li class=""><span>223</span><input type="number" class="nc-ch double_patti_box" name="quantity[223]" min="10" /></li>

<li class=""><span>377</span><input type="number" class="nc-ch double_patti_box" name="quantity[377]" min="10" /></li>

<li class=""><span>449</span><input type="number" class="nc-ch double_patti_box" name="quantity[449]" min="10" /></li>

<li class=""><span>557</span><input type="number" class="nc-ch double_patti_box" name="quantity[557]" min="10" /></li>

<li class=""><span>566</span><input type="number" class="nc-ch double_patti_box" name="quantity[566]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">8</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>800</span><input type="number" class="nc-ch double_patti_box" name="quantity[800]" min="10" /></li>

<li class=""><span>116</span><input type="number" class="nc-ch double_patti_box" name="quantity[116]" min="10" /></li>

<li class=""><span>224</span><input type="number" class="nc-ch double_patti_box" name="quantity[224]" min="10" /></li>

<li class=""><span>233</span><input type="number" class="nc-ch double_patti_box" name="quantity[233]" min="10" /></li>

<li class=""><span>288</span><input type="number" class="nc-ch double_patti_box" name="quantity[288]" min="10" /></li>

<li class=""><span>440</span><input type="number" class="nc-ch double_patti_box" name="quantity[440]" min="10" /></li>

<li class=""><span>477</span><input type="number" class="nc-ch double_patti_box" name="quantity[477]" min="10" /></li>

<li class=""><span>558</span><input type="number" class="nc-ch double_patti_box" name="quantity[558]" min="10" /></li>

<li class=""><span>990</span><input type="number" class="nc-ch double_patti_box" name="quantity[990]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">9</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>900</span><input type="number" class="nc-ch double_patti_box" name="quantity[900]" min="10" /></li>

<li class=""><span>117</span><input type="number" class="nc-ch double_patti_box" name="quantity[117]" min="10" /></li>

<li class=""><span>144</span><input type="number" class="nc-ch double_patti_box" name="quantity[144]" min="10" /></li>

<li class=""><span>199</span><input type="number" class="nc-ch double_patti_box" name="quantity[199]" min="10" /></li>

<li class=""><span>225</span><input type="number" class="nc-ch double_patti_box" name="quantity[225]" min="10" /></li>

<li class=""><span>388</span><input type="number" class="nc-ch double_patti_box" name="quantity[388]" min="10" /></li>

<li class=""><span>559</span><input type="number" class="nc-ch double_patti_box" name="quantity[559]" min="10" /></li>

<li class=""><span>577</span><input type="number" class="nc-ch double_patti_box" name="quantity[577]" min="10" /></li>

<li class=""><span>667</span><input type="number" class="nc-ch double_patti_box" name="quantity[667]" min="10" /></li>
</ul>
</div>
</div>
<div style="border: 1px solid #9b0000;padding: 10px 18px;border-radius: 6px 6px 6px 6px;background: #9b0000;font-size: 19px;color: #fff;width: 50px;margin-bottom: 20px;">0</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>550</span><input type="number" class="nc-ch double_patti_box" name="quantity[550]" min="10" /></li>

<li class=""><span>668</span><input type="number" class="nc-ch double_patti_box" name="quantity[668]" min="10" /></li>

<li class=""><span>244</span><input type="number" class="nc-ch double_patti_box" name="quantity[244]" min="10" /></li>

<li class=""><span>299</span><input type="number" class="nc-ch double_patti_box" name="quantity[299]" min="10" /></li>

<li class=""><span>226</span><input type="number" class="nc-ch double_patti_box" name="quantity[226]" min="10" /></li>

<li class=""><span>488</span><input type="number" class="nc-ch double_patti_box" name="quantity[488]" min="10" /></li>

<li class=""><span>677</span><input type="number" class="nc-ch double_patti_box" name="quantity[677]" min="10" /></li>

<li class=""><span>118</span><input type="number" class="nc-ch double_patti_box" name="quantity[118]" min="10" /></li>

<li class=""><span>334</span><input type="number" class="nc-ch double_patti_box" name="quantity[334]" min="10" /></li>
</ul>
</div>
</div>
<h4>total point : <span id="double_patti_bet">00</span></h4>
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