<?php
include "header.php";
$date=$_GET['date'] ?? '';
$game=$_GET['game'] ?? '';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <font style='color:red;'>
				
			</font>
          </div><!-- /.col -->
          <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item active'>Report</li>
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
                <h3 class='card-title'>Report</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
											
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Market</th><th>Game</th><th>Number</th><th>Amount</th><th>P/L</th>
</thead>
<tbody>
<?php
$total=0;$single=0;$jodi=0;$single_patti=0;$double_patti=0;$tripple_patti=0;
$stmt1 = $db->query("select  NAME from GAMES where ID='$game';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game_name=$row1['NAME'] ?? '';
}
$stmt1 = $db->query("select  SUM(AMOUNT) as AMOUNT, GAME, TYPE, SUM(WIN_AMOUNT) as WIN_AMOUNT, NUMBER from BET_TRANSACTIONS where DATE='$date' and GAME_ID='$game' group by NUMBER, GAME order by AMOUNT DESC;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$number=$row1['NUMBER'] ?? '';
$amount=$row1['AMOUNT'] ?? '';
$type=$row1['TYPE'] ?? '';
$game=$row1['GAME'] ?? '';
$p_l=$row1['WIN_AMOUNT'] ?? '';
if($p_l==""){
	$p_l=0;
}
if($game=="JODI"){
	$game="";
}
echo "<tr><td>$game_name</td><td>$type</td><td>$number</td><td>$amount</td><td>$p_l</td></tr>";
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
