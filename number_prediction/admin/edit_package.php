<?php
include "header.php";
$id=$_GET['id'] ?? '';
$location="";$headline="";$description="";
$stmt1 = $db->query("select IMAGE, LOCATION, HEADLINE, DESCRIPTION  from PACKAGE where ID='$id';");
	while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
	{
		$image=$row1['IMAGE'] ?? '';
		$location=$row1['LOCATION'] ?? '';
		$headline=$row1['HEADLINE'] ?? '';
		$description=$row1['DESCRIPTION'] ?? '';
	}

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#myTextarea',
    height: 350,
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    importcss_append: true,
});
</script>


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
                <h3 class='card-title'>Add/Edit Package</h3>			
              </div>
              <div class='card-body p-0'>
			  		<div class='card-body'>
						<div class='row'>
						<div class='col-md-4'>
						<form action='package_check.php' method='POST' accept='image/jpg,image/jpeg,image/png' enctype='multipart/form-data'>
						<input type='text' name='location'  class='form-control' placeholder='Location' value="<?php echo $location;?>" required><br>
						<input type='hidden' name='id' value="<?php echo $id;?>">
						</div>
						<div class='col-md-4'>
						<input type='text' name='headline' class='form-control' placeholder='Headline' value="<?php echo $headline;?>" required><br>
						</div>
						<div class='col-md-4'>
						<input type='file' name='photo' class='form-control'><br>
						</div>
						<div class='col-md-12'>
						<textarea name='description' id='myTextarea' placeholder='Write Something'><?php echo $description;?></textarea>
						</div>
						</div>
					 </div>
					 <div class='card-footer clearfix'>
						<a href='store.php' class='btn btn-sm btn-primary'>Clear</a>
						<input class='btn btn-sm btn-primary float-right' value='Submit' type='submit'>
						</form>
					</div>
              <!-- /.card-body -->
              
            </div>
			
			
          </div>		
			
			
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
