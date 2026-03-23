<?php
include 'db.php';

if (isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    $stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: index.php");
exit();
?>