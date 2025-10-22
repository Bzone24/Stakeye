<?php
include "header.php";
?>
  <div class='content-wrapper'>
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <h1 class='m-0 text-dark'>Manage Result</h1>
          </div><!-- /.col -->
         <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item'><a href='manage_result.php'>Manage Result</a></li>
              <li class='breadcrumb-item active'>Update Result</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class='content'>
      <div class='container-fluid'>
        <div class='row'>
<?php
$id=$_GET['id'] ?? '';
?>
<div class='col-lg-12'>
<form method="post" action='update_result1.php'>
<?php
echo "<input type='hidden' name='id' value='$id'>";
?>
</div>
<div class='col-lg-12'>
<b>Select Old Date</b>
<input class="form-control" maxlength="100" type="date" name="date" />
<br>
</div>
<div class='col-lg-12'>
<input class="btn btn-primary" type="submit" value="Check Result" />
</form>
</div>
<br>
</div>
</section>
</div>
<?php
include "footer.php";
?>
