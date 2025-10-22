<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id==""){
	header("location: login.php");
}
?>
<br>
<div class="container-fluid">
<div class="container">
<div class='row'>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php
echo "<div class='single-result'>
<h2>SINGLE</h2>
<ul>
<li></li>
<li><a href='starline_single.php'><p class='bold-sec'>10 ka $starline_price</p></a></li>
<li></li>
</ul>
</div>";
?>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php
echo "<div class='single-result'>
<h2>SINGLE PATTI</h2>
<ul>
<li></li>
<li><a href='starline-patti.php'><p class='bold-sec'>10 ka $starline_patti_price</p></a></li>
<li></li>
</ul>
</div>";
?>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php
echo "<div class='single-result'>
<h2>DOUBLE PATTI</h2>
<ul>
<li></li>
<li><a href='starline-double-patti.php'><p class='bold-sec'>10 ka $starline_dpatti_price</p></a></li>
<li></li>
</ul>
</div>";
?>
	</div>

	
</div>
<br><br><br><br><br><br>
</div>
</div>
<br>
<?php
include "footer.php";
?>