<?php
include "header.php";
include "db.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id==""){
	header("location: login.php");
}
?>
<br>
<div class="container-fluid">
<div class="container">
<div class='row'>
	<div class="col-lg-12">
<center>Refer & Earn: <font style='color:red;'>https://<?php echo $domain;?>/registration.php?ref_by=<?php echo $user_id;?></font>
</center>
<br>
	<table class='table'>
	<thead><th>Date</th><th>Amount</th><th>Balance</th></thead>
	<tbody>
<?php
$stmt1 = $db->query("select DATE_FORMAT(DATE_TIME, '%d/%m/%Y %H:%i') as DATE_TIME, AMOUNT, BALANCE, REMARK from TRANSACTIONS where USER_ID='$user_id' and REMARK='Bonus' order by ID DESC;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$amount=$row1['AMOUNT'] ?? '';
$date=$row1['DATE_TIME'] ?? '';
$balance=$row1['BALANCE'] ?? '';
echo "<tr><td>$date</td>";
echo "</td><td>$amount</td><td>$balance</td></tr>";
}
?>
</tbody></table>
	</div>
	

	
</div>
<br><br><br><br><br><br>
</div>
</div>
<br>
<?php
include "footer.php";
?>
