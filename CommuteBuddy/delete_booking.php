<?php
include 'db.php';

$id = $_POST['booking_id'];

$conn->query("DELETE FROM bookings WHERE booking_id = $id");

header("Location: index.php");