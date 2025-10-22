<?php
include "header.php";
$delete_id=$_GET['delete_id'] ?? '';
if($delete_id!=""){
$stmt1 = "delete from PAYMENTS where ID='$delete_id'";
$db->query($stmt1);
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
			<?php echo $_GET['msg'] ?? '';?>
			</font>
          </div><!-- /.col -->
          <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item active'>Manage Payments</li>
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

		  <div class='col-md-12'>
            
			<div class='card'>
              <div class='card-header border-transparent bg-gradient-primary'>
                <h3 class='card-title'>Payment List</h3>
				<a href='edit_payment.php' style='float:right;color:white;'>Add Fake Payment <i class='fa fa-plus'></i></a>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                        <div class='row'>
                                                <div class='col-md-12'>
												
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Name</th><th>Mode</th><th>Amount</th><th>Action</th>
</thead>
<tbody>
<?php
$stmt2 = $db->query("select ID, NAME, MODE, AMOUNT from PAYMENTS order by DATE DESC limit 10;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$id=$row2['ID'] ?? '';
$u_name=$row2['NAME'] ?? '';
$mode=$row2['MODE'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
echo "<tr><td>$u_name</td><td>$mode</td><td>$amount</td><td>
<a href='?delete_id=$id' onclick=\"return confirm('Are you sure you want to delete this package?');\"><i class='fa fa-trash'></i></a>
</td></tr>";
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

          <div class='col-md-4'>
            <!-- Info Boxes Style 2 -->
            
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
