<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";


if($user_id=="" || $admin==""){
	header("location: logout.php");
}
$package_count=0;
$store_count="";
$sql2 = $db->query("select count(*) as count from USERS;");
while($row2 = $sql2->fetch(PDO::FETCH_ASSOC))
{
$user_count=$row2['count'];
}
$sql2 = $db->query("select SUM(WALLET) as WALLET from USERS;");
while($row2 = $sql2->fetch(PDO::FETCH_ASSOC))
{
$total_wallet=$row2['WALLET'];
}
$sql2 = $db->query("select count(*) as count from BET_TRANSACTIONS where STATUS='';");
while($row2 = $sql2->fetch(PDO::FETCH_ASSOC))
{
$bet_count=$row2['count'];
}
$sql2 = $db->query("select count(*) as count from PAYMENT_QUEUE where (STATUS='' or STATUS is NULL);");
while($row2 = $sql2->fetch(PDO::FETCH_ASSOC))
{
$payment_count=$row2['count'];
}
$sql2 = $db->query("select count(*) as count from WITHDRAW where (STATUS='' or STATUS is NULL);");
while($row2 = $sql2->fetch(PDO::FETCH_ASSOC))
{
$with_count=$row2['count'];
}
$index_active="";$user_active="";$bet_active="";$trans_active="";$report_active="";$refresh_active="";$settings_active="";$payment_active="";$winner_active="";$games_active="";$password_active="";$result_active="";
$page=basename($_SERVER['SCRIPT_NAME']);
if($page == "index.php"){
    $index_active="active";
}
if($page == "users.php" || $page=="user_edit.php" || $page=="user_transactions.php" || $page=="user_bet.php"){
	$user_active="active";
}
if($page == "bets.php"){
    $bet_active="active";
}
if($page == "transactions.php"){
    $trans_active="active";
}
if($page == "report.php" || $page=="report1.php"){
    $report_active="active";
}
if($page == "refresh.php"){
    $refresh_active="active";
}
if($page=="settings.php"){
	$settings_active="active";
}
if($page=="winner.php"){
	$winner_active="active";
}
if($page=="payment.php"){
	$payment_active="active";
}
if($page=="reset_password.php"){
	$password_active="active";
}
if($page == "manage_result.php" || $page=="edit_result.php" || $page=="update_result.php"){
        $result_active="active";
}
if($page == "password_reset.php"){
    $password_active="active";
}
if($page == "manage_guess.php"){
    $guess_active="active";
}
if($page == "manage_games.php"){
    $games_active="active";
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <title>Admin Panel</title>
  <link rel='stylesheet' href='plugins/fontawesome-free/css/all.min.css'>
  <link rel='stylesheet' href='plugins/overlayScrollbars/css/OverlayScrollbars.min.css'>
  <link rel='stylesheet' href='dist/css/adminlte.min.css'>
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' rel='stylesheet'>
  <link rel='icon' type='image/png' href='images/logo.png'/>
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
</head>
<body class='hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed'>
<div class='wrapper'>
  <nav class='main-header navbar navbar-expand navbar-white navbar-light'>
    <!-- Right navbar links -->
<ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class='navbar-nav ml-auto'>
      <!-- Messages Dropdown Menu -->
      <li class='nav-item'>
        <a class='nav-link'  href='logout.php'>
          <i class='fa fa-sign-out-alt' title='Log out'></i>
        </a>
      </li>
    </ul>
  </nav>
  <aside class='main-sidebar sidebar-dark-primary elevation-4'>
    <a href='index.php' class='brand-link'>
      <img src='logo.png' alt='Logo' class='brand-image img-circle elevation-3'
           style='opacity: .8'>
      <span class='brand-text font-weight-light'>Admin Panel</span>
    </a>
    <div class='sidebar'>
      <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
        <div class='info'>
          <a href='' class='d-block'>Welcome Admin</a>
        </div>
      </div>
      <nav class='mt-2'>
        <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
<?php
		echo "
		<li class='nav-item'>
            <a href='index.php' class='nav-link $index_active'>
              <i class='nav-icon fas fa-tachometer-alt'></i>
              <p>
                Dashbaord
              </p>
            </a>
		</li>
		<li class='nav-item'>
            <a href='users.php' class='nav-link $user_active'>
              <i class='nav-icon fas fa-users'></i>
              <p>
                Manage Users
              </p>
            </a>
		</li>
<li class='nav-item'>
    <a href='manage_result.php' class='nav-link $result_active'>
    <i class='nav-icon fas fa-poll'></i>
    <p>
        Manage Result
        </p>
        </a>
</li>
		<li class='nav-item'>
            <a href='bets.php' class='nav-link $bet_active'>
              <i class='nav-icon fas fa-rupee-sign'></i>
              <p>
                Manage Bets
              </p>
            </a>
		</li>
<li class='nav-item'>
    <a href='manage_games.php' class='nav-link $games_active'>
    <i class='nav-icon fas fa-gamepad'></i>
    <p>
        Manage Games
        </p>
        </a>
</li>
		<li class='nav-item'>
            <a href='transactions.php' class='nav-link $trans_active'>
              <i class='nav-icon fas fa-file-invoice'></i>
              <p>
                All Transactions
              </p>
            </a>
		</li>
		<li class='nav-item'>
            <a href='report.php' class='nav-link $report_active'>
              <i class='nav-icon fas fa-chart-line'></i>
              <p>
                Report
              </p>
            </a>
		</li>
		<li class='nav-item'>
            <a href='winner.php' class='nav-link $winner_active'>
              <i class='nav-icon fas fa-trophy'></i>
              <p>
                Winner
              </p>
            </a>
		</li>
		<li class='nav-item'>
            <a href='payment.php' class='nav-link $payment_active'>
              <i class='nav-icon fas fa-rupee-sign'></i>
              <p>
                Latest Payments
              </p>
            </a>
		</li>
		<li class='nav-item'>
            <a href='settings.php' class='nav-link $settings_active'>
              <i class='nav-icon fas fa-cogs'></i>
              <p>
                Settings
              </p>
            </a>
		</li>
		<li class='nav-item'>
            <a href='refresh.php' class='nav-link $refresh_active'>
              <i class='nav-icon fas fa-sync-alt'></i>
              <p>
                Refresh Result
              </p>
            </a>
		</li>
                <li class='nav-item'>
            <a href='reset_password.php' class='nav-link $password_active'>
              <i class='nav-icon fas fa-key'></i>
              <p>
                Password Reset
              </p>
            </a>
                </li>";
	
?>	
        </ul>
      </nav>
    </div>
  </aside>
