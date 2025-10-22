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
              <li class='breadcrumb-item active'>Manage Users</li>
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
                <h3 class='card-title'>User's List</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                
												
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Name</th><th>Mobile</th><th>Wallet</th><th>Action</th>
</thead>
<tbody>
<?php
if($id==""){
$stmt1 = $db->query("select ID, NAME, MOBILE, WALLET from USERS order by NAME;");
}else{
$stmt1 = $db->query("select ID, NAME, MOBILE, WALLET from USERS where ID='$id';");	
}
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$mobile=$row1['MOBILE'] ?? '';
$name=$row1['NAME'] ?? '';
$wallet=$row1['WALLET'] ?? '';
echo "<tr><td>$name</td><td>$mobile</td><td>$wallet</td><td>
<a href='user_edit.php?id=$id'><i class='fa fa-pen'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='user_transactions.php?id=$id'><i class='fa fa-receipt'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='user_bet.php?id=$id'><i class='fa fa-rupee-sign'></i></a>
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
