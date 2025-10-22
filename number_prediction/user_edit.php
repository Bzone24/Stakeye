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
              <li class='breadcrumb-item active'>Edit User</li>
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
                <h3 class='card-title'>User's Details</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                
<?php
$stmt1 = $db->query("select ID, NAME, MOBILE, WALLET, EMAIL, GOOGLE_ID, IMAGE from USERS where ID='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$mobile=$row1['MOBILE'] ?? '';
$name=$row1['NAME'] ?? '';
$wallet=$row1['WALLET'] ?? '';
$email=$row1['EMAIL'] ?? '';
$google_id=$row1['GOOGLE_ID'] ?? '';
$image=$row1['IMAGE'] ?? '';
}
echo "
<div class='row'>
<div class='col-lg-6'>
<form action='user_check.php' method='POST'>
<input type='hidden' name='id' value='$id'>
<input type='text' class='form-control' name='name' value='$name'><br>
<input type='number' class='form-control' name='mobile' value='$mobile'><br>
<input type='text' class='form-control' name='email' value='$email'><br>
</div>
<div class='col-lg-6'>
<input type='text' class='form-control' name='wallet' value='$wallet' disabled><br>
<input type='text' class='form-control' name='google_id' value='$google_id' disabled><br>
<input type='text' class='form-control' name='password' placeholder='New Password'><br>
</div>
<div class='col-lg-6'>
<input type='number' class='form-control' name='amount' placeholder='Amount to Credit/Debit'><br>
<input type='text' class='form-control' name='mode' placeholder='Payment Mode'><br>
</div>
<div class='col-lg-6'>
<input type='text' class='form-control' name='remark' placeholder='Reason'><br>
</div>
</div>
";

?>

												
				</div>
				
				<div class='card-footer clearfix'>
                <input class='btn btn-sm btn-primary float-right' value='Update' type='submit'>
                                </form>
              </div>
				
				</div></div>
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
