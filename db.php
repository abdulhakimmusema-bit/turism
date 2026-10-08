<?php
$conn = new mysqli("localhost", "root", "", "tourism_final");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
?>
