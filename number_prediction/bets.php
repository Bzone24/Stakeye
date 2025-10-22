<?php
include "header.php";
include "db.php";
$user_id = $_SESSION["USER_ID"] ?? "";
if ($user_id == "") {
    header("location: login.php");
}
?>
<br>
<div class="container-fluid">
    <div class="container">
        <div class='row'>
            <div class="col-lg-12">
                <!-- Add table-responsive here -->
                <div class="table-responsive">
                    <table class='table table-bordered table-hover'>
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Market</th>
                                <th>Game</th>
                                <th>Number</th>
                                <th>Amount</th>
                                <th>Result</th>
                                <th>Winning Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $id = $_GET["id"] ?? "";
                        if ($id == "") {
                            $stmt1 = $db->query("SELECT ID, DATE_FORMAT(DATE_TIME, '%d/%m/%Y %H:%i') as DATE_TIME, AMOUNT, GAME_ID, GAME, TYPE, NUMBER, DATE_FORMAT(DATE, '%d/%m/%Y') as DATE, RESULT, STATUS, NUMBER1, WIN_AMOUNT FROM BET_TRANSACTIONS WHERE USER_ID='$user_id' ORDER BY ID DESC;");
                        } else {
                            $stmt1 = $db->query("SELECT ID, DATE_FORMAT(DATE_TIME, '%d/%m/%Y %H:%i') as DATE_TIME, AMOUNT, GAME_ID, GAME, TYPE, NUMBER, DATE_FORMAT(DATE, '%d/%m/%Y') as DATE, RESULT, STATUS, NUMBER1 , WIN_AMOUNT FROM BET_TRANSACTIONS WHERE USER_ID='$user_id' AND ID='$id';");
                        }
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $wallet = $row1["WALLET"] ?? "";
                            $b_id = $row1["ID"] ?? "";
                            $amount = $row1["AMOUNT"] ?? "";
                            $t_date = $row1["DATE_TIME"] ?? "";
                            $date = $row1["DATE"] ?? "";
                            $game_id = $row1["GAME_ID"] ?? "";
                            $game = $row1["GAME"] ?? "";
                            $bet_id = $row1["BET_ID"] ?? "";
                            $result = $row1["RESULT"] ?? "";
                            $status = $row1["STATUS"] ?? "";
                            $number = $row1["NUMBER"] ?? "";
                            $type = $row1["TYPE"] ?? "";
                            $number1 = $row1["NUMBER1"] ?? "";
                            $winAmount = $row1["WIN_AMOUNT"] ?? "";
                            $game_name = "";
                            if ($status == "DELETED" && $result == "") {
                                $result = "DELETED";
                            }
                            $stmt2 = $db->query("SELECT NAME FROM GAMES WHERE ID='$game_id';");
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                $game_name = $row2["NAME"] ?? "";
                            }
                            if ($game == "JODI") {
                                $game = "";
                            }
                            if ($type == "Full Sangam") {
                                $number = "Open: $number<br>Close: $number1";
                            }
                            if ($type == "Half Sangam" && $game == "close") {
                                $number = "Close Patti: $number<br>Open Ank: $number1";
                                $game = "";
                            }
                            if ($type == "Half Sangam" && $game == "open") {
                                $number = "Open Patti: $number<br>Close Ank: $number1";
                                $game = "";
                            }
                            if ($game_id == "37") {
                                if ($game < 12) {
                                    $game = "$game AM";
                                }
                                if ($game > 12) {
                                    $game = $game - 12;
                                    $game = "$game PM";
                                }
                                if ($game == "12") {
                                    $game = "$game PM";
                                }
                            }
                            echo "<tr><td>#$b_id</td><td>$date</td><td>$game_name</td><td>$type</td><td style='max-width: 200px;
    text-wrap: wrap;'>".
                            str_replace(",",", ",$number)."</td><td>$amount</td><td>$result</td><td>$winAmount</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
    </div>
</div>
<br>
<?php include "footer.php";
?>
