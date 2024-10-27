<?php
$host = "localhost"; // Database host
$db_name = "marketing_system"; // Database name
$username = "root"; // Your DB username
$password = ""; // Your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
