<?php
$servername = "localhost";
$phone_numbber = "root";
$amount = "root";
$balance = "root";
$dbname = "transfer_db";

// Create connection
$conn = new mysqli($servername, $phone_number, $amount, $balance, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>