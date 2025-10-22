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
            <h1 class='m-0 text-dark'>Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class='content'>
      <div class='container-fluid'>
        <!-- Info boxes -->
        <div class='row'>
          <div class='col-12 col-sm-6 col-md-3'>
            <div class='info-box'>
              <span class='info-box-icon bg-info elevation-1'><i class='fas fa-users'></i></span>

              <div class='info-box-content'>
			  <a href='users.php' style='color:black;'>
                <span class='info-box-text'>Users</span>
                <span class='info-box-number'>
                  <?php echo $user_count;?>
                </span>
				</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
		  <div class='col-12 col-sm-6 col-md-3'>
            <div class='info-box mb-3'>
              <span class='info-box-icon bg-success elevation-1'><i class='fas fa-wallet'></i></span>
              <div class='info-box-content'>
			  <a href='' style='color:black;'>
                <span class='info-box-text'>Total Wallet</span>
                <span class='info-box-number'>
				<?php echo $total_wallet;?>
				</span>
				</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class='col-12 col-sm-6 col-md-3'>
            <div class='info-box mb-3'>
              <span class='info-box-icon bg-danger elevation-1'><i class='fas fa-clipboard'></i></span>
              <div class='info-box-content'>
			  <a href='bets.php' style='color:black;'>
                <span class='info-box-text'>Pending Bet</span>
                <span class='info-box-number'>
				<?php echo $bet_count;?>
				</span>
				</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		  <div class='col-12 col-sm-6 col-md-3'>
            <div class='info-box mb-3'>
              <span class='info-box-icon bg-black elevation-1'><i class='fas fa-rupee-sign'></i></span>
              <div class='info-box-content'>
			  <a href='payment_queue.php' style='color:black;'>
                <span class='info-box-text'>Recharge Queue</span>
                <span class='info-box-number'>
				<?php echo $payment_count;?>
				</span>
				</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
                  <div class='col-12 col-sm-6 col-md-3'>
            <div class='info-box mb-3'>
              <span class='info-box-icon bg-warning elevation-1'><i class='fas fa-rupee-sign'></i></span>
              <div class='info-box-content'>
                          <a href='with_queue.php' style='color:black;'>
                <span class='info-box-text'>Withdraw Queue</span>
                <span class='info-box-number'>
                                <?php echo $with_count;?>
                                </span>
                                </a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- fix for small devices only -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->

		
        
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include "footer.php";
?>
