<?php
include "header.php";
$delete_id=$_GET['delete_id'] ?? '';
if($delete_id!=""){
$stmt1 = $db->query("select IMAGE from STORE where ID='$delete_id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$d_photo=$row1['IMAGE'] ?? '';
}
if($d_photo!=""){
        unlink("../images/$d_photo");
}
$stmt1 = "delete from STORE where ID='$delete_id';";
$db->query($stmt1);
}
$id=$_GET['id'] ?? '';
$name1="";$price1="";
$stmt1 = $db->query("select IMAGE, NAME, PRICE  from STORE where ID='$id';");
	while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
	{
		$image1=$row1['IMAGE'] ?? '';
		$name1=$row1['NAME'] ?? '';
		$price1=$row1['PRICE'] ?? '';		
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
              <li class='breadcrumb-item active'>Manage Packages</li>
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
                <h3 class='card-title'>Package List</h3>
				<a href='edit_package.php' style='float:right;color:white;'>Add Package <i class='fa fa-plus'></i></a>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                        <div class='row'>
                                                <div class='col-md-12'>
												
<table id='example2' class="table table-bordered table-striped">
<thead>
<th>Image</th><th>Location</th><th>Headline</th><th>Action</th>
</thead>
<tbody>
<?php
$stmt1 = $db->query("select ID, IMAGE, LOCATION, HEADLINE from PACKAGE order by ID DESC;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$image=$row1['IMAGE'] ?? '';
$location=$row1['LOCATION'] ?? '';
$headline=$row1['HEADLINE'] ?? '';
echo "<tr><td><img src='../images/$image' style='width:50px;height:50px;'></td><td>$location</td><td>$headline</td><td>
<a href='edit_package.php?id=$id'><i class='fa fa-pen'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
