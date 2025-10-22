<?php
        define('DB_SERVER', 'localhost');
        define('DB_USER', 'stak_db_matka');
        define('DB_PASSWORD', 'CjxhDd2KDGYLraR2');
        define('DB_NAME', 'stak_db_matka');

try {
    $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
