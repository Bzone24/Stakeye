<?php
include "header.php";
$id=$_GET['id'] ?? '';
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
			  <li class='breadcrumb-item'><a href='users.php'>Manage Users</a></li>
              <li class='breadcrumb-item active'>User's Transactions</li>
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
                <h3 class='card-title'>User's Transactions</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                
<?php
$stmt1 = $db->query("select NAME, MOBILE, WALLET from USERS where ID='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$name=$row1['NAME'] ?? '';
$mobile=$row1['MOBILE'] ?? '';
$wallet=$row1['WALLET'] ?? '';
}							
echo "<div class='row' style='font-weight:bold;'><div class='col-lg-3'><a href='users.php?id=$id'>$name</a></div><div class='col-lg-3'>Mob.: $mobile</div><div class='col-lg-3'>Wallet: $wallet</div></div><br>";
?>																								
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Transaction Time</th><th>Game</th><th>Amount</th><th>Balance</th><th>Bet ID</th>
</thead>
<tbody>
<?php
$stmt1 = $db->query("select DATE_FORMAT(DATE_TIME, '%d/%m/%Y %H:%i') as DATE_TIME, AMOUNT, REMARK, GAME_ID, GAME, BET_ID, BALANCE from TRANSACTIONS where USER_ID='$id' order by ID DESC;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$remark=$row1['REMARK'] ?? '';
$amount=$row1['AMOUNT'] ?? '';
$date=$row1['DATE_TIME'] ?? '';
$game_id=$row1['GAME_ID'] ?? '';
$game=$row1['GAME'] ?? '';
$bet_id=$row1['BET_ID'] ?? '';
$balance=$row1['BALANCE'] ?? '';
$game_name="";
$stmt2 = $db->query("select NAME from GAMES where ID='$game_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$game_name=$row2['NAME'] ?? '';
}
if($game_name!=""){
	$amount="-$amount";
	$remark="";
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
echo "<tr><td>$date</td><td>$game_name $game $remark</td><td>$amount</td><td>$balance</td><td>#<a href='user_bet.php?id=$id&b_id=$bet_id'>$bet_id</a></td></tr>";
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
