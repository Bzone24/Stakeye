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
<th>Market</th><th>Action</th>
</thead>
<tbody>
<?php
$stmt3 = $db->query("select  ID, NAME from GAMES where (PLAY='checked' and ID IN (select GAME_ID from RESULT where DATE=CURDATE())) or ID='37';");
while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
{
$game_id=$row3['ID'] ?? '';
$game_name=$row3['NAME'] ?? '';
if($game_id=="37"){
echo "<tr><td>$game_name</td><td><form action='refresh_check1.php' method='POST'><input type='number' name='time' class='form-control' placeholder='Time (10-22)'></td>
<td><input type='submit' class='btn btn-primary'></form></td></tr>";	
}else{
echo "<tr><td>$game_name</td>
<td><a href='refresh_check.php?game=$game_id'><i class='fa fa-sync-alt'></i></a></td></tr>";
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
