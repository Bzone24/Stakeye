<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
$date=$_GET['date'] ?? '';
$date1=date("Y-m-d");
if($date!=""){
	$error="";
function checkString($string){
  if (strtotime($string)) {
      $error="TRUE";
  }
  else {
      $error="FALSE";
  } 
}
$check_date=checkString($date);
if($error=="FALSE"){
	$date="";
}
}
?>

<div class="container-fluid">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<center><h2>STARLINE CHART</h2></center>
</div>
</div>
<div class="row">
<div class="col-lg-6 col-xs-6">
<form>
<input type='date' name='date' max="<?php echo $date1;?>" value="<?php echo $date;?>" class='form-control'>
</div>
<div class="col-lg-6 col-xs-6">
<input type='submit' value='Submit' class='btn btn-danger'>
</form>
</div>
</div>
<br><br>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="time-table">
<table>
<tr>
<th>TIME</th>
<th>RESULT</th>
</tr>
<?php
for ($x=10; $x<=22; $x++){
	if($x>=10 && $x<=22){
$starline_result="";
if($date==""){
$stmt1 = $db->query("select RESULT from STARLINE where DATE(TIME)=CURDATE() and HOUR(TIME)='$x';");
}else{
$stmt1 = $db->query("select RESULT from STARLINE where DATE(TIME)='$date' and HOUR(TIME)='$x';");	
}
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
	$starline_result=$row1['RESULT'] ?? '';
}
if($x<="11"){
	$y="$x AM";
}
if($x=="12"){
	$y="$x PM";
}
if($x > 12){
	$y=$x - 12;
	$y="$y PM";
}
if($starline_result==""){
echo "<tr>
<td>$y</td>
<td>***-*</td>
</tr>";	
}else{
	$starline_open=$starline_result[0] + $starline_result[1] + $starline_result[2];
	$starline_open=substr($starline_open, -1);
echo "<tr>
<td>$y</td>
<td>$starline_result-$starline_open</td>
</tr>";
}
}
}
?>
</table>
</div>
</div>
</div>
</div>
</div>

<?php
include "footer.php";
?>