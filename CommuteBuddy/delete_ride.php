<?php
include 'db.php';

if (isset($_POST['ride_id'])) {
    $ride_id = $_POST['ride_id'];

    // Delete bookings first (to avoid FK issues)
    $stmt = $conn->prepare("DELETE FROM bookings WHERE ride_id = ?");
    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $stmt->close();

    // Delete the ride
    $stmt2 = $conn->prepare("DELETE FROM rides WHERE ride_id = ?");
    $stmt2->bind_param("i", $ride_id);
    $stmt2->execute();
    $stmt2->close();
}

header("Location: index.php");
exit();
?>