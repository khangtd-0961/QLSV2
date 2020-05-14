<?php
$serverName = 'localhost';
$userName = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$serverName;dbname=QLSV3", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
