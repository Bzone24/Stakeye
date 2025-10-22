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
                        <form action="jodi_check.php" method="POST" name="jodi_frm" id="jodi_frm">
                            <h2>NUMBER (J) </h2>
                            <h3>Select Your Game</h3>
                            <font style='color:red;'>
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
                                            $stmt1 = $db->query("select ID, NAME, DATE_FORMAT(TIME1,'%h:%i %p') as TIME,CLOSING_TIME from GAMES where PLAY='checked' order by TIME1;");
                                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                $id = $row1['ID'] ?? '';
                                                $name = $row1['NAME'] ?? '';
                                                $time1 = $row1['TIME'] ?? '';
                                                $closingTime = $row1['CLOSING_TIME']??10;
                                                $check_id = "";
                                               
                                              $db->query("SET time_zone = '+05:30'");
                                                $stmt2 = $db->query("select ID,TIME1 from GAMES where ID='$id' and TIME1 > now() + INTERVAL ".$closingTime." MINUTE  and DAYS >= $day  and (HOLIDAY='' or HOLIDAY is NULL);");
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
                            <div class="row jodi-opt">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="number-area">
                                        <ul>
                                            <li class="num btn"><span>00</span></li>
                                            <li class="num btn"><span>01</span></li>
                                            <li class="num btn"><span>02</span></li>
                                            <li class="num btn"><span>03</span></li>
                                            <li class="num btn"><span>04</span></li>
                                            <li class="num btn"><span>05</span></li>
                                            <li class="num btn"><span>06</span></li>
                                            <li class="num btn"><span>07</span></li>
                                            <li class="num btn"><span>08</span></li>
                                            <li class="num btn"><span>09</span></li>
                                            <li class="num btn"><span>10</span></li>
                                            <li class="num btn"><span>11</span></li>
                                            <li class="num btn"><span>12</span></li>
                                            <li class="num btn"><span>13</span></li>
                                            <li class="num btn"><span>14</span></li>
                                            <li class="num btn"><span>15</span></li>
                                            <li class="num btn"><span>16</span></li>
                                            <li class="num btn"><span>17</span></li>
                                            <li class="num btn"><span>18</span></li>
                                            <li class="num btn"><span>19</span></li>
                                            <li class="num btn"><span>20</span></li>
                                            <li class="num btn"><span>21</span></li>
                                            <li class="num btn"><span>22</span></li>
                                            <li class="num btn"><span>23</span></li>
                                            <li class="num btn"><span>24</span></li>
                                            <li class="num btn"><span>25</span></li>
                                            <li class="num btn"><span>26</span></li>
                                            <li class="num btn"><span>27</span></li>
                                            <li class="num btn"><span>28</span></li>
                                            <li class="num btn"><span>29</span></li>
                                            <li class="num btn"><span>30</span></li>
                                            <li class="num btn"><span>31</span></li>
                                            <li class="num btn"><span>32</span></li>
                                            <li class="num btn"><span>33</span></li>
                                            <li class="num btn"><span>34</span></li>
                                            <li class="num btn"><span>35</span></li>
                                            <li class="num btn"><span>36</span></li>
                                            <li class="num btn"><span>37</span></li>
                                            <li class="num btn"><span>38</span></li>
                                            <li class="num btn"><span>39</span></li>
                                            <li class="num btn"><span>40</span></li>
                                            <li class="num btn"><span>41</span></li>
                                            <li class="num btn"><span>42</span></li>
                                            <li class="num btn"><span>43</span></li>
                                            <li class="num btn"><span>44</span></li>
                                            <li class="num btn"><span>45</span></li>
                                            <li class="num btn"><span>46</span></li>
                                            <li class="num btn"><span>47</span></li>
                                            <li class="num btn"><span>48</span></li>
                                            <li class="num btn"><span>49</span></li>
                                            <li class="num btn"><span>50</span></li>
                                            <li class="num btn"><span>51</span></li>
                                            <li class="num btn"><span>52</span></li>
                                            <li class="num btn"><span>53</span></li>
                                            <li class="num btn"><span>54</span></li>
                                            <li class="num btn"><span>55</span></li>
                                            <li class="num btn"><span>56</span></li>
                                            <li class="num btn"><span>57</span></li>
                                            <li class="num btn"><span>58</span></li>
                                            <li class="num btn"><span>59</span></li>
                                            <li class="num btn"><span>60</span></li>
                                            <li class="num btn"><span>61</span></li>
                                            <li class="num btn"><span>62</span></li>
                                            <li class="num btn"><span>63</span></li>
                                            <li class="num btn"><span>64</span></li>
                                            <li class="num btn"><span>65</span></li>
                                            <li class="num btn"><span>66</span></li>
                                            <li class="num btn"><span>67</span></li>
                                            <li class="num btn"><span>68</span></li>
                                            <li class="num btn"><span>69</span></li>
                                            <li class="num btn"><span>70</span></li>
                                            <li class="num btn"><span>71</span></li>
                                            <li class="num btn"><span>72</span></li>
                                            <li class="num btn"><span>73</span></li>
                                            <li class="num btn"><span>74</span></li>
                                            <li class="num btn"><span>75</span></li>
                                            <li class="num btn"><span>76</span></li>
                                            <li class="num btn"><span>77</span></li>
                                            <li class="num btn"><span>78</span></li>
                                            <li class="num btn"><span>79</span></li>
                                            <li class="num btn"><span>80</span></li>
                                            <li class="num btn"><span>81</span></li>
                                            <li class="num btn"><span>82</span></li>
                                            <li class="num btn"><span>83</span></li>
                                            <li class="num btn"><span>84</span></li>
                                            <li class="num btn"><span>85</span></li>
                                            <li class="num btn"><span>86</span></li>
                                            <li class="num btn"><span>87</span></li>
                                            <li class="num btn"><span>88</span></li>
                                            <li class="num btn"><span>89</span></li>
                                            <li class="num btn"><span>90</span></li>
                                            <li class="num btn"><span>91</span></li>
                                            <li class="num btn"><span>92</span></li>
                                            <li class="num btn"><span>93</span></li>
                                            <li class="num btn"><span>94</span></li>
                                            <li class="num btn"><span>95</span></li>
                                            <li class="num btn"><span>96</span></li>
                                            <li class="num btn"><span>97</span></li>
                                            <li class="num btn"><span>98</span></li>
                                            <li class="num btn"><span>99</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="show-input">
                                <p id="clone-cls" style="display: none;"><span class="b-num">00</span><input
                                            class="jodi_box" type="number" name="quantity" min='10'><span class="d-box"><i
                                                class="fa fa-times div-can" aria-hidden="true"></i></span>
                                <p>
                            </div>
                            <h4>total point : <span id="jodi_bet">00</span></h4>
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
