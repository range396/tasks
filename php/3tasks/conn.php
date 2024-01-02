<?php

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "visitors_tracker";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES 'utf8mb4_unicode_ci'");
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}