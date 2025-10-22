<?php
include "header.php";
$user_id = $_SESSION['USER_ID'] ?? '';
$date1 = date("Y-m-d");
$date1_1 = date("d/M/Y");
$date2 = date("Y-m-d", strtotime("+1 day"));
$date2_1 = date("d/M/Y", strtotime("+1 day"));
$date3 = date("Y-m-d", strtotime("+2 day"));
$date3_1 = date("d/M/Y", strtotime("+2 day"));
$date = $_GET['date'] ?? '';
if ($date != "") {
    if ($date < $date1) {
        $date = $date1;
    }
    if ($date > $date3) {
        $date = $date3;
    }
    $date_1 = date("d/M/Y", strtotime($date));
    $day = date("N", strtotime($date));
} else {
    $day = date("N");
}
?>

<div class="main-body">
    <div class="container-fluid">
        <div class="row play-game-area">
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 play">
                    
                        <br/>
       <?php if (!empty($_GET['msg'])): ?>
<div class="alert alert-danger">
	<?php echo htmlspecialchars($_GET['msg']); ?>
</div>
<?php endif; ?>

<?php if (!empty($_GET['success'])): ?>
<div class="alert alert-success">
	<?php echo htmlspecialchars($_GET['success']); ?>
</div>
<?php endif; ?>


                    <div class="all-option2">
                        <form action="cross_check.php" method="POST" name="jodi_frm" id="jodi_frm">
                            <h2>CROSS </h2>
                            <h3>Select Your Game</h3>
                            <font style='color:green;'>
                                <?php echo $_GET['msg'] ?? ''; ?>
                            </font>
                            <div class="row main-top">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                    <div class="sele-date-area">
                                        <select name="date" id="bet_date"
                                                onchange="window.location='?date='+this.value">
                                            <?php
                                            if ($date != "") {
                                                echo "<option value='$date'>$date_1</option>";
                                            }
                                            if ($date != $date1) {
                                                ?>
                                                <option value="<?php echo $date1; ?>"><?php echo $date1_1; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                    <div class="sele-area">
                                        <select name="market" id="jodi_dropdown" required>
                                            <option value="" disabled selected>------- Select Market -------</option>
                                            <?php
                                            $stmt1 = $db->query("select ID, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME, CLOSING_TIME from GAMES where PLAY='checked' order by TIME1;");
                                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                $id = $row1['ID'] ?? '';
                                                $name = $row1['NAME'] ?? '';
                                                $time1 = $row1['TIME'] ?? '';
                                                $closing_time = $row1['CLOSING_TIME'] ?? 10; // Default to 10 minutes if CLOSING_TIME is not set

                                                $check_id = "";
                                                 $db->query("SET time_zone = '+05:30'");
                                                $stmt2 = $db->query("select ID from GAMES where ID='$id' and TIME1 > now() + INTERVAL $closing_time MINUTE and DAYS >= $day and (HOLIDAY='' or HOLIDAY is NULL);");
                                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                    $check_id = $row2['ID'] ?? '';
                                                }

                                                if ($check_id == "" && ($date == "" || $date == $date1)) {
                                                    echo "<option disabled value='$id'>$name ($time1)</option>";
                                                } else {
                                                    echo "<option value='$id'>$name  ($time1)</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php include "number-combination-generator.php"; ?>

                            <h4>total point : <span id="total_bet">00</span></h4>
                            <input
                                    class="jodi_box" id="cross_quantity" type="hidden" name="quantity">

                            <input
                                    class="jodi_box" id="combinations" type="hidden" name="combinations">
                            <div class="play-butt"><input type="submit" value="Submit Game"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include "footer.php";
?>
