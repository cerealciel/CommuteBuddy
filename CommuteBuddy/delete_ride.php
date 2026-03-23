<?php
include 'db.php';

$id = $_POST['ride_id'];

$conn->query("DELETE FROM bookings WHERE ride_id = $id");
$conn->query("DELETE FROM rides WHERE ride_id = $id");

header("Location: index.php");