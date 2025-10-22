<?php
include "header.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <font style='color:red;'>
			<?php echo $_GET['msg'] ?? '';?>
			</font>
          </div><!-- /.col -->
          <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item active'>Manage Bets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class='content'>
      <div class='container-fluid'>
        <div class='row'>
			<div class='col-12'>
            <div class='card'>
              <div class='card-header border-transparent bg-gradient-primary'>
                <h3 class='card-title'>Manage Bets</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
											
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>#</th><th>Transaction</th><th>Date</th><th>Market</th><th>Game</th><th>Number</th><th>Amount</th><th>Result</th><th>Action</th>
</thead>
<tbody>
<?php
$stmt1 = $db->query("select ID, USER_ID, NUMBER, NUMBER1, DATE_FORMAT(DATE_TIME, '%d/%m/%Y') as DATE_TIME, AMOUNT, GAME_ID, GAME, DATE_FORMAT(DATE, '%d/%m/%Y') as DATE, RESULT, STATUS, TYPE from BET_TRANSACTIONS order by ID DESC;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$b_id=$row1['ID'] ?? '';
$amount=$row1['AMOUNT'] ?? '';
$t_date=$row1['DATE_TIME'] ?? '';
$date=$row1['DATE'] ?? '';
$game_id=$row1['GAME_ID'] ?? '';
$game=$row1['GAME'] ?? '';
$bet_id=$row1['BET_ID'] ?? '';
$result=$row1['RESULT'] ?? '';
$status=$row1['STATUS'] ?? '';
$id=$row1['USER_ID'] ?? '';
$number=$row1['NUMBER'] ?? '';
$number1=$row1['NUMBER1'] ?? '';
$type=$row1['TYPE'] ?? '';
$game_name="";
if($status=="DELETED" && $result==""){
	$result="DELETED";
}
$stmt2 = $db->query("select NAME from GAMES where ID='$game_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$game_name=$row2['NAME'] ?? '';
}
if($type=="Full Sangam"){
	$number="Open: $number<br>Close: $number1";
}
if($type=="Half Sangam" && $game=="close"){
	$number="Close Patti: $number<br>Open Ank: $number1";
	$game="";
}
if($type=="Half Sangam" && $game=="open"){
	$number="Open Patti: $number<br>Close Ank: $number1";
	$game="";
}
if($game_id=="37"){
	if($game < 12){
		$game="$game AM";
	}
	if($game > 12){
		$game=$game - 12;
		$game="$game PM";
	}
	if($game == "12"){
		$game="$game PM";
	}
}
echo "<tr><td>#$b_id</td><td>$t_date</td><td>$date</td><td>$game_name $game</td><td>$type</td><td>$number</td><td>$amount</td><td>$result</td><td>";
if($result=="" && $status!="DELETED"){
echo "<a href='delete_bet.php?id=$id&b_id=$b_id' title='Delete this bet' onclick=\"return confirm('Are you sure you want to delete this bet?');\"><i class='fa fa-trash'></i></a>";
}
echo "</td></tr>";
}

?>
</tbody>
</table>												
												
				</div></div></div>
              </div>
              <!-- /.card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
		  
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include "footer.php";
?>
