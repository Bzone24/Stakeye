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
              <li class='breadcrumb-item active'>All Transactions</li>
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
                <h3 class='card-title'>All Transactions</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                
												
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Transaction</th><th>Name</th><th>Game</th><th>Amount</th><th>Balance</th><th>Bet ID</th>
</thead>
<tbody>
<?php
$id=$_GET['id'] ?? '';
if($id==""){
$stmt1 = $db->query("select REMARK, DATE_FORMAT(DATE_TIME, '%d/%m/%Y') as DATE_TIME, AMOUNT, GAME_ID, GAME, BET_ID, BALANCE, USER_ID from TRANSACTIONS order by ID DESC;");
}else{
$stmt1 = $db->query("select REMARK, DATE_FORMAT(DATE_TIME, '%d/%m/%Y') as DATE_TIME, AMOUNT, GAME_ID, GAME, BET_ID, BALANCE, USER_ID from TRANSACTIONS where USER_ID='$id' order by ID DESC;");
}
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$remark=$row1['REMARK'] ?? '';
$amount=$row1['AMOUNT'] ?? '';
$date=$row1['DATE_TIME'] ?? '';
$game_id=$row1['GAME_ID'] ?? '';
$game=$row1['GAME'] ?? '';
$bet_id=$row1['BET_ID'] ?? '';
$balance=$row1['BALANCE'] ?? '';
$u_id=$row1['USER_ID'] ?? '';
$game_name="";$u_name="";
$stmt2 = $db->query("select NAME from GAMES where ID='$game_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$game_name=$row2['NAME'] ?? '';
}
$stmt2 = $db->query("select NAME from USERS where ID='$u_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$u_name=$row2['NAME'] ?? '';
}
if($game_name!=""){
	$amount="-$amount";
	$remark="";
}
echo "<tr><td>$date</td><td><a href='users.php?id=$u_id'>$u_name</a></td><td>$game_name $remark</td><td>$amount</td><td>$balance</td><td>#<a href='user_bet.php?id=$u_id&b_id=$bet_id'>$bet_id</a></td></tr>";
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
