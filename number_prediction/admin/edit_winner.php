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
              <li class='breadcrumb-item active'>Add Winner</li>
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
                <h3 class='card-title'>Add Winner</h3>			
              </div>
              <div class='card-body p-0'>
			  		<div class='card-body'>
						<div class='row'>
						<div class='col-md-4'>
						<form action='winner_check.php' method='POST'>
						<input type='text' name='name'  class='form-control' placeholder='Name' required><br>
						</div>
						<div class='col-md-4'>
						<input type='number' name='win_amount' class='form-control' placeholder='Winning Amount' required><br>
						</div>
						<div class='col-md-4'>
						<input type='number' name='amount' class='form-control' placeholder='Bet Amount' required><br>
						</div>
						<div class='col-md-4'>
						<input type='text' name='game' class='form-control' placeholder='Game' required><br>
						</div>
						</div>
					 </div>
					 <div class='card-footer clearfix'>
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
