<?php
include "header.php";
$date=$_GET['date'] ?? '';
if($date==""){
$date=date("Y-m-d");
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <font style='color:red;'>
				<form>
			<?php
			echo "<input name='date' type='date' value='$date'>";
			?>
			<input type='submit' value='Change Date' class='btn btn-primary'>
			<form>
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
<th>Market</th><th>Total</th><th>Single</th><th>Jodi</th><th>Bahar</th><th>cross</th><th>P/L</th><th>View</th>
</thead>
<tbody>
<?php
$stmt3 = $db->query("select  ID, NAME from GAMES where PLAY='checked' order by TIME1;");
while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
{
$game_id=$row3['ID'] ?? '';
$game_name=$row3['NAME'] ?? '';
$total=0;$andar=0;$jodi=0;$bahar=0;$cross=0;
$stmt1 = $db->query("select  SUM(AMOUNT) as AMOUNT, GAME_ID, GAME, TYPE, SUM(WIN_AMOUNT) as WIN_AMOUNT from BET_TRANSACTIONS where DATE='$date' and GAME_ID='$game_id' group by TYPE;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
    

$amount=$row1['AMOUNT'] ?? '';
$type=$row1['TYPE'] ?? '';
$p_l=$row1['WIN_AMOUNT'] ?? '';

if($p_l==""){
	$p_l=0;
}
if($type=="Andar"){
	$andar=$amount;
}
if($type=="Jodi"){
	$jodi=$amount;
}
if($type=="Bahar"){
	$bahar=$amount;
}
if($type=="Cross"){
	$cross=$amount;
}
$total=$andar + $jodi + $bahar +$cross;
}
if($total!=0){
$p_l=$total - $p_l;
echo "<tr><td>$game_name</td><td>$total</td><td>$andar</td><td>$jodi</td><td>$bahar</td><td>$cross</td><td>$p_l</td>
<td><a href='report1.php?date=$date&game=$game_id'><i class='fa fa-eye'></i></a></td></tr>";
}
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
