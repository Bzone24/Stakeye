<?php
include "header.php"; 

?>
<div class='content-wrapper'>
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row mb-2'>
                <div class='col-sm-6'>
                    <h1 class='m-0 text-dark'>Manage Games</h1>
                </div><!-- /.col -->
                <div class='col-sm-6'>
                    <ol class='breadcrumb float-sm-right'>
                        <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                        <li class='breadcrumb-item active'>Manage Games</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class='content'>
        <div class='container-fluid'>
            <div class='row'>

                <?php
                $game = "";
                $delete_id = $_GET['delete_id'] ?? '';
                $msg = $_GET['msg'] ?? '';
                if ($delete_id != "") {
                    $stmt1 = "delete from GAMES where ID='$delete_id';";
                    $db->query($stmt1);
                    $msg = "Game Deleted";
                }
                if ($msg != "") {
                    echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> $msg !</div>";
                }
                $id = $_GET['id'] ?? '';
                if ($id != "") {
                    $stmt1 = $db->query("select COLOR, NAME, TIME1, GUESS, HIGHLIGHT, JODI_RESULT, PANEL_RESULT, DAYS, HOLIDAY,INACTIVE, AUTO_GUESS,CLOSING_TIME,linked_game from GAMES where ID='$id';");
                    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $color = $row1['COLOR'] ?? '';
                        $auto_guess = $row1['AUTO_GUESS'] ?? '';
                        $game = $row1['NAME'] ?? '';
                        $time1 = $row1['TIME1'] ?? '';
                        $closing_time = $row1['CLOSING_TIME'] ?? '';
                        $highlight = $row1['HIGHLIGHT'] ?? '';
                        $holiday = $row1['HOLIDAY'] ?? '';
                        $days = $row1['DAYS'] ?? '';
                         $linked_game = $row1['linked_game']??0;
                        if ($guess == "YES") {
                            $guess = "checked";
                        }
                    }
                }
                ?>
                </div>
                  <div class='row'>
                <div class='col-lg-3'>
                    <form method="post" action='game_check.php'>
                        <?php
                        echo "<input type='hidden' name='id' value='$id'>";
                        ?>
                        <b>Game Name</b>
                        <input class="form-control" maxlength="100" type="text" name="name" value="<?php echo $game; ?>"
                               placeholder='Game Name' required/>
                        <br>
                </div>
                
                
                    <div class='col-lg-3'>
                     
                    <b>Link with Game Name</b>
                    <select name='linked_game' class='form-control' required>
                        <option selected disabled value="0">Select</option>
                        
      
  <option value="disawer" <?php echo $linked_game == 'disawer' ? 'selected="selected"' : ''; ?>>DISAWER</option>
  <option value="new_punjab" <?php echo $linked_game == 'new_punjab' ? 'selected="selected"' : ''; ?>>NEW PUNJAB</option>
  <option value="moon_day" <?php echo $linked_game == 'moon_day' ? 'selected="selected"' : ''; ?>>MOON DAY</option>
  <option value="hr_satta" <?php echo $linked_game == 'hr_satta' ? 'selected="selected"' : ''; ?>>HR SATTA</option>
  <option value="mahamaya_satta" <?php echo $linked_game == 'mahamaya_satta' ? 'selected="selected"' : ''; ?>>MAHAMAYA SATTA</option>
  <option value="mj_king" <?php echo $linked_game == 'mj_king' ? 'selected="selected"' : ''; ?>>MJ KING</option>
  <option value="sadar_bazar" <?php echo $linked_game == 'sadar_bazar' ? 'selected="selected"' : ''; ?>>SADAR BAZAR</option>
  <option value="jaipur_king" <?php echo $linked_game == 'jaipur_king' ? 'selected="selected"' : ''; ?>>JAIPUR KING</option>
  <option value="rajdhani_jaipur" <?php echo $linked_game == 'rajdhani_jaipur' ? 'selected="selected"' : ''; ?>>RAJDHANI JAIPUR</option>
  <option value="agra_bazar" <?php echo $linked_game == 'agra_bazar' ? 'selected="selected"' : ''; ?>>AGRA BAZAR</option>
  <option value="gangotri" <?php echo $linked_game == 'gangotri' ? 'selected="selected"' : ''; ?>>GANGOTRI</option>
  <option value="karol_bagh" <?php echo $linked_game == 'karol_bagh' ? 'selected="selected"' : ''; ?>>KAROL BAGH</option>
  <option value="gali_disawar_mix" <?php echo $linked_game == 'gali_disawar_mix' ? 'selected="selected"' : ''; ?>>GALI DISAWAR MIX</option>
  <option value="gwalior" <?php echo $linked_game == 'gwalior' ? 'selected="selected"' : ''; ?>>GWALIOR</option>
  <option value="vinti" <?php echo $linked_game == 'vinti' ? 'selected="selected"' : ''; ?>>VINTI</option>
  <option value="meerut_city" <?php echo $linked_game == 'meerut_city' ? 'selected="selected"' : ''; ?>>MEERUT CITY</option>
  <option value="gujarat_city" <?php echo $linked_game == 'gujarat_city' ? 'selected="selected"' : ''; ?>>GUJARAT CITY</option>
  <option value="khandala" <?php echo $linked_game == 'khandala' ? 'selected="selected"' : ''; ?>>KHANDALA</option>
  <option value="delhi_bazar" <?php echo $linked_game == 'delhi_bazar' ? 'selected="selected"' : ''; ?>>DELHI BAZAR</option>
  <option value="mohali" <?php echo $linked_game == 'mohali' ? 'selected="selected"' : ''; ?>>MOHALI</option>
  <option value="badlapur" <?php echo $linked_game == 'badlapur' ? 'selected="selected"' : ''; ?>>BADLAPUR</option>
  <option value="maa_bhagwati" <?php echo $linked_game == 'maa_bhagwati' ? 'selected="selected"' : ''; ?>>MAA BHAGWATI</option>
  <option value="shri_pathaan" <?php echo $linked_game == 'shri_pathaan' ? 'selected="selected"' : ''; ?>>SHRI PATHAAN</option>
  <option value="rajdarbar" <?php echo $linked_game == 'rajdarbar' ? 'selected="selected"' : ''; ?>>RAJDARBAR</option>
  <option value="super_delhi" <?php echo $linked_game == 'super_delhi' ? 'selected="selected"' : ''; ?>>SUPER DELHI</option>
  <option value="kalka_bazar" <?php echo $linked_game == 'kalka_bazar' ? 'selected="selected"' : ''; ?>>KALKA BAZAR</option>
  <option value="shiv_shakti" <?php echo $linked_game == 'shiv_shakti' ? 'selected="selected"' : ''; ?>>SHIV SHAKTI</option>
  <option value="dhanvarsha" <?php echo $linked_game == 'dhanvarsha' ? 'selected="selected"' : ''; ?>>DHANVARSHA</option>
  <option value="goldstar" <?php echo $linked_game == 'goldstar' ? 'selected="selected"' : ''; ?>>GOLDSTAR</option>
  <option value="up_bazar" <?php echo $linked_game == 'up_bazar' ? 'selected="selected"' : ''; ?>>UP BAZAR</option>
  <option value="shri_ganesh" <?php echo $linked_game == 'shri_ganesh' ? 'selected="selected"' : ''; ?>>SHRI GANESH</option>
  <option value="vasudev" <?php echo $linked_game == 'vasudev' ? 'selected="selected"' : ''; ?>>VASUDEV</option>
  <option value="ghaziabad_din" <?php echo $linked_game == 'ghaziabad_din' ? 'selected="selected"' : ''; ?>>GHAZIABAD DIN</option>
  <option value="agra" <?php echo $linked_game == 'agra' ? 'selected="selected"' : ''; ?>>AGRA</option>
  <option value="faridabad" <?php echo $linked_game == 'faridabad' ? 'selected="selected"' : ''; ?>>FARIDABAD</option>
  <option value="alwar" <?php echo $linked_game == 'alwar' ? 'selected="selected"' : ''; ?>>ALWAR</option>
  <option value="neelkanth" <?php echo $linked_game == 'neelkanth' ? 'selected="selected"' : ''; ?>>NEELKANTH</option>
  <option value="jambo" <?php echo $linked_game == 'jambo' ? 'selected="selected"' : ''; ?>>JAMBO</option>
  <option value="raj_shree" <?php echo $linked_game == 'raj_shree' ? 'selected="selected"' : ''; ?>>RAJ SHREE</option>
  <option value="palwal_-_pw" <?php echo $linked_game == 'palwal_-_pw' ? 'selected="selected"' : ''; ?>>PALWAL - PW</option>
  <option value="south_delhi" <?php echo $linked_game == 'south_delhi' ? 'selected="selected"' : ''; ?>>SOUTH DELHI</option>
  <option value="paras" <?php echo $linked_game == 'paras' ? 'selected="selected"' : ''; ?>>PARAS</option>
  <option value="shri_laxmi" <?php echo $linked_game == 'shri_laxmi' ? 'selected="selected"' : ''; ?>>SHRI LAXMI</option>
  <option value="ghaziabad" <?php echo $linked_game == 'ghaziabad' ? 'selected="selected"' : ''; ?>>GHAZIABAD</option>
  <option value="tirupati" <?php echo $linked_game == 'tirupati' ? 'selected="selected"' : ''; ?>>TIRUPATI</option>
  <option value="delhi_super" <?php echo $linked_game == 'delhi_super' ? 'selected="selected"' : ''; ?>>DELHI SUPER</option>
  <option value="dwarka" <?php echo $linked_game == 'dwarka' ? 'selected="selected"' : ''; ?>>DWARKA</option>
  <option value="sangrur" <?php echo $linked_game == 'sangrur' ? 'selected="selected"' : ''; ?>>SANGRUR</option>
  <option value="bala_ji_dadri" <?php echo $linked_game == 'bala_ji_dadri' ? 'selected="selected"' : ''; ?>>BALA JI DADRI</option>
  <option value="bheem_bazar" <?php echo $linked_game == 'bheem_bazar' ? 'selected="selected"' : ''; ?>>BHEEM BAZAR</option>
  <option value="daman" <?php echo $linked_game == 'daman' ? 'selected="selected"' : ''; ?>>DAMAN</option>
  <option value="royal_satta_king" <?php echo $linked_game == 'royal_satta_king' ? 'selected="selected"' : ''; ?>>ROYAL SATTA KING</option>
  <option value="rishikesh" <?php echo $linked_game == 'rishikesh' ? 'selected="selected"' : ''; ?>>RISHIKESH</option>
  <option value="gali" <?php echo $linked_game == 'gali' ? 'selected="

selected"' : ''; ?>>GALI</option>
</select>

                    <br>
            </div>
            
            
                <div class='col-lg-3'>
                    <b>Time1</b>
                    <input class="form-control" maxlength="100" type="time" name="time1" value="<?php echo $time1; ?>"
                           placeholder='Time 1' required/>
                    <br>
                </div>

                <div class='col-lg-3'>
                    <b>Closing Time</b>
                    <input class="form-control" maxlength="100" type="number" name="closing_time" value="<?php echo $closing_time; ?>"
                           placeholder='Bat closing time' required/>
                    <br>
                </div>
                <div class='col-lg-3'>
                    <b>Days</b>
                    <select name='days' class='form-control' required>
                        <?php
                        if ($days == "" || $days == "7") {
                            echo "<option value='7'>Monday to Sunday</option>";
                            echo "<option value='6'>Monday to Saturday</option>";
                            echo "<option value='5'>Monday to Friday</option>";
                            echo "<option value='4'>Monday to Thursday</option>";
                            echo "<option value='3'>Monday to Wednesday</option>";
                        }
                        if ($days == "6") {
                            echo "<option value='6'>Monday to Saturday</option>";
                            echo "<option value='7'>Monday to Sunday</option>";
                            echo "<option value='5'>Monday to Friday</option>";
                            echo "<option value='4'>Monday to Thursday</option>";
                            echo "<option value='3'>Monday to Wednesday</option>";
                        }
                        if ($days == "5") {
                            echo "<option value='5'>Monday to Friday</option>";
                            echo "<option value='7'>Monday to Sunday</option>";
                            echo "<option value='6'>Monday to Saturday</option>";
                            echo "<option value='4'>Monday to Thursday</option>";
                            echo "<option value='3'>Monday to Wednesday</option>";
                        }
                        if ($days == "4") {
                            echo "<option value='4'>Monday to Thursday</option>";
                            echo "<option value='7'>Monday to Sunday</option>";
                            echo "<option value='6'>Monday to Saturday</option>";
                            echo "<option value='5'>Monday to Friday</option>";
                            echo "<option value='3'>Monday to Wednesday</option>";
                        }
                        if ($days == "3") {
                            echo "<option value='3'>Monday to Wednesday</option>";
                            echo "<option value='7'>Monday to Sunday</option>";
                            echo "<option value='6'>Monday to Saturday</option>";
                            echo "<option value='5'>Monday to Friday</option>";
                            echo "<option value='4'>Monday to Thursday</option>";
                        }
                        ?>
                    </select>
                    <br>
                </div>
                <div class='col-lg-3'>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Update"/>
                    <br><br>
                    </form>
                </div>
                <div class='col-lg-12'>
                    <table border='1' style='width:100%;'>
                        <form action='holiday_check.php' method='POST'>
                            <tr style='background-color:blue;color:white;text-align:center;'>
                                <td>#</td>
                                <td>Game</td>
                                <td>Result Time</td>
                                <td>Linked With</td>
                                <td>Closing Time</td>
                                <td>Holiday</td>
                                <td>Action</td>
                            </tr>
                            <?php
                            $stmt1 = $db->query("select ID, HOLIDAY, NAME, PAGE, GUESS, DATE_FORMAT(TIME1, '%h:%i %p') as TIME1, DATE_FORMAT(TIME2, '%h:%i %p') as TIME2 , CLOSING_TIME,linked_game from GAMES order by TIME1;");
                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                $holiday = $row1['HOLIDAY'] ?? '';
                                $id = $row1['ID'] ?? '';
                                $name = $row1['NAME'] ?? '';
                                $time1 = $row1['TIME1'] ?? '';
                                $time2 = $row1['TIME2'] ?? '';
                                $page = $row1['PAGE'] ?? '';
                                $guess = $row1['GUESS'] ?? '';
                                $close = $row1['CLOSING_TIME'] ?? '';
                                $linedWith = strtoupper(str_replace("_"," ",$row1['linked_game']));
                                
                                echo "<tr><td>$id</td><td>$name</td><td>$time1</td><td>$linedWith</td><td>$close</td><td>
<input type='checkbox' name='holiday_$id' value='checked' $holiday>
</td><td><a href='?id=$id'><i class='fa fa-pen'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?delete_id=$id' onclick=\"return confirm('Are you sure you want to delete this game?');\"><i class='fa fa-trash'></i></a></td></tr>";
                            }
                            ?>
                            <tr>
                                <td colspan='4'></td>
                                <td><input type='submit' class='btn btn-primary' value='Update'></td>
                                <td></td>
                            </tr>
                        </form>
                    </table>
                    <br>
                </div>
            </div>
    </section>
</div>
<?php
include "footer.php";
?>
