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
<div class="row play-game-area">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
<div class="all-option2">
<form action="single-patti_check.php" method="POST" name="single_patti_frm" id="single_patti_frm">
<h2>SINGLE PATTI (10 KA <?php echo $s_patti_price;?>)</h2>
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
$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL 10 MINUTE  and DAYS >= $day  and (HOLIDAY='' or HOLIDAY is NULL);");
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
if($id=="14000000000000000"){
$stmt2 = $db->query("select ID from GAMES where ID='$id' and '23:55:00' > CURTIME() + INTERVAL 10 MINUTE  and DAYS >= $day and (HOLIDAY='' or HOLIDAY is NULL);");	
}else{
$stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME2 > now() + INTERVAL 10 MINUTE  and DAYS >= $day and (HOLIDAY='' or HOLIDAY is NULL);");
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

<div class="s-p-hed">1</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>128</span><input type="number" class="nc-ch single_patti_box" name="quantity[128]" min="10" /></li>

<li class=""><span>137</span><input type="number" class="nc-ch single_patti_box" name="quantity[137]" min="10" /></li>

<li class=""><span>146</span><input type="number" class="nc-ch single_patti_box" name="quantity[146]" min="10" /></li>

<li class=""><span>236</span><input type="number" class="nc-ch single_patti_box" name="quantity[236]" min="10" /></li>

<li class=""><span>245</span><input type="number" class="nc-ch single_patti_box" name="quantity[245]" min="10" /></li>

<li class=""><span>290</span><input type="number" class="nc-ch single_patti_box" name="quantity[290]" min="10" /></li>

<li class=""><span>380</span><input type="number" class="nc-ch single_patti_box" name="quantity[380]" min="10" /></li>

<li class=""><span>470</span><input type="number" class="nc-ch single_patti_box" name="quantity[470]" min="10" /></li>

<li class=""><span>489</span><input type="number" class="nc-ch single_patti_box" name="quantity[489]" min="10" /></li>

<li class=""><span>560</span><input type="number" class="nc-ch single_patti_box" name="quantity[560]" min="10" /></li>

<li class=""><span>678</span><input type="number" class="nc-ch single_patti_box" name="quantity[678]" min="10" /></li>

<li class=""><span>579</span><input type="number" class="nc-ch single_patti_box" name="quantity[579]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">2</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>129</span><input type="number" class="nc-ch single_patti_box" name="quantity[129]" min="10" /></li>

<li class=""><span>138</span><input type="number" class="nc-ch single_patti_box" name="quantity[138]" min="10" /></li>

<li class=""><span>147</span><input type="number" class="nc-ch single_patti_box" name="quantity[147]" min="10" /></li>

<li class=""><span>156</span><input type="number" class="nc-ch single_patti_box" name="quantity[156]" min="10" /></li>

<li class=""><span>237</span><input type="number" class="nc-ch single_patti_box" name="quantity[237]" min="10" /></li>

<li class=""><span>246</span><input type="number" class="nc-ch single_patti_box" name="quantity[246]" min="10" /></li>

<li class=""><span>345</span><input type="number" class="nc-ch single_patti_box" name="quantity[345]" min="10" /></li>

<li class=""><span>390</span><input type="number" class="nc-ch single_patti_box" name="quantity[390]" min="10" /></li>

<li class=""><span>480</span><input type="number" class="nc-ch single_patti_box" name="quantity[480]" min="10" /></li>

<li class=""><span>570</span><input type="number" class="nc-ch single_patti_box" name="quantity[570]" min="10" /></li>

<li class=""><span>679</span><input type="number" class="nc-ch single_patti_box" name="quantity[679]" min="10" /></li>

<li class=""><span>589</span><input type="number" class="nc-ch single_patti_box" name="quantity[589]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">3</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>120</span><input type="number" class="nc-ch single_patti_box" name="quantity[120]" min="10" /></li>

<li class=""><span>139</span><input type="number" class="nc-ch single_patti_box" name="quantity[139]" min="10" /></li>
 
<li class=""><span>148</span><input type="number" class="nc-ch single_patti_box" name="quantity[148]" min="10" /></li>

<li class=""><span>157</span><input type="number" class="nc-ch single_patti_box" name="quantity[157]" min="10" /></li>

<li class=""><span>238</span><input type="number" class="nc-ch single_patti_box" name="quantity[238]" min="10" /></li>

<li class=""><span>247</span><input type="number" class="nc-ch single_patti_box" name="quantity[247]" min="10" /></li>

<li class=""><span>256</span><input type="number" class="nc-ch single_patti_box" name="quantity[256]" min="10" /></li>

<li class=""><span>346</span><input type="number" class="nc-ch single_patti_box" name="quantity[346]" min="10" /></li>

<li class=""><span>490</span><input type="number" class="nc-ch single_patti_box" name="quantity[490]" min="10" /></li>

<li class=""><span>580</span><input type="number" class="nc-ch single_patti_box" name="quantity[580]" min="10" /></li>

<li class=""><span>670</span><input type="number" class="nc-ch single_patti_box" name="quantity[670]" min="10" /></li>

<li class=""><span>689</span><input type="number" class="nc-ch single_patti_box" name="quantity[689]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">4</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>130</span><input type="number" class="nc-ch single_patti_box" name="quantity[130]" min="10" /></li>

<li class=""><span>149</span><input type="number" class="nc-ch single_patti_box" name="quantity[149]" min="10" /></li>

<li class=""><span>158</span><input type="number" class="nc-ch single_patti_box" name="quantity[158]" min="10" /></li>

<li class=""><span>167</span><input type="number" class="nc-ch single_patti_box" name="quantity[167]" min="10" /></li>

<li class=""><span>239</span><input type="number" class="nc-ch single_patti_box" name="quantity[239]" min="10" /></li>

<li class=""><span>248</span><input type="number" class="nc-ch single_patti_box" name="quantity[248]" min="10" /></li>

<li class=""><span>257</span><input type="number" class="nc-ch single_patti_box" name="quantity[257]" min="10" /></li>

<li class=""><span>347</span><input type="number" class="nc-ch single_patti_box" name="quantity[347]" min="10" /></li>

<li class=""><span>356</span><input type="number" class="nc-ch single_patti_box" name="quantity[356]" min="10" /></li>

<li class=""><span>590</span><input type="number" class="nc-ch single_patti_box" name="quantity[590]" min="10" /></li>

<li class=""><span>680</span><input type="number" class="nc-ch single_patti_box" name="quantity[680]" min="10" /></li>

<li class=""><span>789</span><input type="number" class="nc-ch single_patti_box" name="quantity[789]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">5</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>140</span><input type="number" class="nc-ch single_patti_box" name="quantity[140]" min="10" /></li>

<li class=""><span>159</span><input type="number" class="nc-ch single_patti_box" name="quantity[159]" min="10" /></li>

<li class=""><span>168</span><input type="number" class="nc-ch single_patti_box" name="quantity[168]" min="10" /></li>

<li class=""><span>230</span><input type="number" class="nc-ch single_patti_box" name="quantity[230]" min="10" /></li>

<li class=""><span>249</span><input type="number" class="nc-ch single_patti_box" name="quantity[249]" min="10" /></li>

<li class=""><span>258</span><input type="number" class="nc-ch single_patti_box" name="quantity[258]" min="10" /></li>

 <li class=""><span>267</span><input type="number" class="nc-ch single_patti_box" name="quantity[267]" min="10" /></li>

<li class=""><span>348</span><input type="number" class="nc-ch single_patti_box" name="quantity[348]" min="10" /></li>

<li class=""><span>357</span><input type="number" class="nc-ch single_patti_box" name="quantity[357]" min="10" /></li>

<li class=""><span>456</span><input type="number" class="nc-ch single_patti_box" name="quantity[456]" min="10" /></li>

<li class=""><span>690</span><input type="number" class="nc-ch single_patti_box" name="quantity[690]" min="10" /></li>

<li class=""><span>780</span><input type="number" class="nc-ch single_patti_box" name="quantity[780]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">6</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>123</span><input type="number" class="nc-ch single_patti_box" name="quantity[123]" min="10" /></li>

<li class=""><span>150</span><input type="number" class="nc-ch single_patti_box" name="quantity[150]" min="10" /></li>

<li class=""><span>169</span><input type="number" class="nc-ch single_patti_box" name="quantity[169]" min="10" /></li>

<li class=""><span>178</span><input type="number" class="nc-ch single_patti_box" name="quantity[178]" min="10" /></li>

<li class=""><span>240</span><input type="number" class="nc-ch single_patti_box" name="quantity[240]" min="10" /></li>

<li class=""><span>259</span><input type="number" class="nc-ch single_patti_box" name="quantity[259]" min="10" /></li>

<li class=""><span>268</span><input type="number" class="nc-ch single_patti_box" name="quantity[268]" min="10" /></li>

<li class=""><span>349</span><input type="number" class="nc-ch single_patti_box" name="quantity[349]" min="10" /></li>

<li class=""><span>358</span><input type="number" class="nc-ch single_patti_box" name="quantity[358]" min="10" /></li>

<li class=""><span>457</span><input type="number" class="nc-ch single_patti_box" name="quantity[457]" min="10" /></li>

<li class=""><span>367</span><input type="number" class="nc-ch single_patti_box" name="quantity[367]" min="10" /></li>

<li class=""><span>790</span><input type="number" class="nc-ch single_patti_box" name="quantity[790]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">7</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>124</span><input type="number" class="nc-ch single_patti_box" name="quantity[124]" min="10" /></li>

<li class=""><span>160</span><input type="number" class="nc-ch single_patti_box" name="quantity[160]" min="10" /></li>

<li class=""><span>179</span><input type="number" class="nc-ch single_patti_box" name="quantity[179]" min="10" /></li>

<li class=""><span>250</span><input type="number" class="nc-ch single_patti_box" name="quantity[250]" min="10" /></li>

<li class=""><span>269</span><input type="number" class="nc-ch single_patti_box" name="quantity[269]" min="10" /></li>

<li class=""><span>278</span><input type="number" class="nc-ch single_patti_box" name="quantity[278]" min="10" /></li>

<li class=""><span>340</span><input type="number" class="nc-ch single_patti_box" name="quantity[340]" min="10" /></li>

<li class=""><span>359</span><input type="number" class="nc-ch single_patti_box" name="quantity[359]" min="10" /></li>

<li class=""><span>368</span><input type="number" class="nc-ch single_patti_box" name="quantity[368]" min="10" /></li>

<li class=""><span>458</span><input type="number" class="nc-ch single_patti_box" name="quantity[458]" min="10" /></li>

<li class=""><span>467</span><input type="number" class="nc-ch single_patti_box" name="quantity[467]" min="10" /></li>
 
<li class=""><span>890</span><input type="number" class="nc-ch single_patti_box" name="quantity[890]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">8</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>125</span><input type="number" class="nc-ch single_patti_box" name="quantity[125]" min="10" /></li>

<li class=""><span>134</span><input type="number" class="nc-ch single_patti_box" name="quantity[134]" min="10" /></li>

<li class=""><span>170</span><input type="number" class="nc-ch single_patti_box" name="quantity[170]" min="10" /></li>

<li class=""><span>189</span><input type="number" class="nc-ch single_patti_box" name="quantity[189]" min="10" /></li>

<li class=""><span>260</span><input type="number" class="nc-ch single_patti_box" name="quantity[260]" min="10" /></li>

<li class=""><span>279</span><input type="number" class="nc-ch single_patti_box" name="quantity[279]" min="10" /></li>

<li class=""><span>350</span><input type="number" class="nc-ch single_patti_box" name="quantity[350]" min="10" /></li>

<li class=""><span>369</span><input type="number" class="nc-ch single_patti_box" name="quantity[369]" min="10" /></li>

<li class=""><span>378</span><input type="number" class="nc-ch single_patti_box" name="quantity[378]" min="10" /></li>

<li class=""><span>459</span><input type="number" class="nc-ch single_patti_box" name="quantity[459]" min="10" /></li>

<li class=""><span>567</span><input type="number" class="nc-ch single_patti_box" name="quantity[567]" min="10" /></li>

<li class=""><span>468</span><input type="number" class="nc-ch single_patti_box" name="quantity[468]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">9</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>126</span><input type="number" class="nc-ch single_patti_box" name="quantity[126]" min="10" /></li>

<li class=""><span>135</span><input type="number" class="nc-ch single_patti_box" name="quantity[135]" min="10" /></li>

<li class=""><span>180</span><input type="number" class="nc-ch single_patti_box" name="quantity[180]" min="10" /></li>

<li class=""><span>234</span><input type="number" class="nc-ch single_patti_box" name="quantity[234]" min="10" /></li>

<li class=""><span>270</span><input type="number" class="nc-ch single_patti_box" name="quantity[270]" min="10" /></li>

<li class=""><span>289</span><input type="number" class="nc-ch single_patti_box" name="quantity[289]" min="10" /></li>

<li class=""><span>360</span><input type="number" class="nc-ch single_patti_box" name="quantity[360]" min="10" /></li>

<li class=""><span>379</span><input type="number" class="nc-ch single_patti_box" name="quantity[379]" min="10" /></li>

<li class=""><span>450</span><input type="number" class="nc-ch single_patti_box" name="quantity[450]" min="10" /></li>

<li class=""><span>469</span><input type="number" class="nc-ch single_patti_box" name="quantity[469]" min="10" /></li>

<li class=""><span>478</span><input type="number" class="nc-ch single_patti_box" name="quantity[478]" min="10" /></li>

<li class=""><span>568</span><input type="number" class="nc-ch single_patti_box" name="quantity[568]" min="10" /></li>
</ul>
</div>
</div>
<div class="s-p-hed">0</div>
<div class="sing-option">
<div class="sing1">
<ul>

<li class=""><span>127</span><input type="number" class="nc-ch single_patti_box" name="quantity[127]" min="10" /></li>

<li class=""><span>136</span><input type="number" class="nc-ch single_patti_box" name="quantity[136]" min="10" /></li>

<li class=""><span>145</span><input type="number" class="nc-ch single_patti_box" name="quantity[145]" min="10" /></li>

<li class=""><span>190</span><input type="number" class="nc-ch single_patti_box" name="quantity[190]" min="10" /></li>

<li class=""><span>235</span><input type="number" class="nc-ch single_patti_box" name="quantity[235]" min="10" /></li>

<li class=""><span>280</span><input type="number" class="nc-ch single_patti_box" name="quantity[280]" min="10" /></li>

<li class=""><span>370</span><input type="number" class="nc-ch single_patti_box" name="quantity[370]" min="10" /></li>

<li class=""><span>479</span><input type="number" class="nc-ch single_patti_box" name="quantity[479]" min="10" /></li>

<li class=""><span>460</span><input type="number" class="nc-ch single_patti_box" name="quantity[460]" min="10" /></li>

<li class=""><span>569</span><input type="number" class="nc-ch single_patti_box" name="quantity[569]" min="10" /></li>

<li class=""><span>389</span><input type="number" class="nc-ch single_patti_box" name="quantity[389]" min="10" /></li>

<li class=""><span>578</span><input type="number" class="nc-ch single_patti_box" name="quantity[578]" min="10" /></li>
</ul>
</div>
</div>
<h4>total point : <span id="single_patti_bet">00</span></h4>
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
