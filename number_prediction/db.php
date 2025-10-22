<?php
$db = new PDO('mysql:host=localhost;dbname=stak_db_matka;charset=utf8mb4', 'stak_db_matka', 'ebErHdTfkfecN3Th');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
