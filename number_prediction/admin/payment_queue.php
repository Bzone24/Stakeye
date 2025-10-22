<?php
include "header.php";
$delete_id=$_GET['delete_id'] ?? '';
if($delete_id!=""){
$stmt1 = "update PAYMENT_QUEUE set STATUS='DELETED' where ID='$delete_id'";
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
              <li class='breadcrumb-item active'>Manage Recharge Queue</li>
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
                <h3 class='card-title'>Recharge Queue</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                        <div class='row'>
                                                <div class='col-md-12'>
												
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Date</th><th>Name</th><th>Mobile</th><th>Mode</th><th>Amount</th><th>Screenshot</th><th>Action</th>
</thead>
<tbody>
<?php
$stmt2 = $db->query("select ID, USER_ID, MODE, AMOUNT, IMAGE, DATE_FORMAT(TIME, '%d/%m/%Y') as TIME from PAYMENT_QUEUE where STATUS is NULL order by ID DESC;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$id=$row2['ID'] ?? '';
$user_id1=$row2['USER_ID'] ?? '';
$mode=$row2['MODE'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
$time=$row2['TIME'] ?? '';
$image=$row2['IMAGE'] ?? '';
$u_name="";$u_mobile="";
$stmt1 = $db->query("select NAME, MOBILE from USERS where ID='$user_id1';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$u_name=$row1['NAME'] ?? '';
$u_mobile=$row1['MOBILE'] ?? '';
}
echo "<tr><td>$time</td><td><a href='users.php?id=$user_id1'>$u_name</a></td><td>$u_mobile</td><td>$mode</td><td>$amount</td><td><a href='../files/$image' target='_blank'><img src='../files/$image' style='width:100px;width:200px;'></a></td><td>
<a href='accept_payment.php?id=$id' onclick=\"return confirm('Are you sure you want to accept this payment?');\"><i class='fa fa-thumbs-up'></i></a>&nbsp;&nbsp;&nbsp;
<a href='?delete_id=$id' onclick=\"return confirm('Are you sure you want to delete this payment?');\"><i class='fa fa-trash'></i></a>
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
