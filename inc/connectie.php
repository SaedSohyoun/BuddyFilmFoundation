<?php
$conn = new mysqli("localhost", "root", "", "bff");
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>