<?php
$conn = new mysqli("localhost", "root", "", "imposter");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>