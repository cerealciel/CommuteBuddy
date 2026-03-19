<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ride_id = $_POST['ride_id'];
    $rider_name = $_POST['rider_name'];

    // Insert rider into users table
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, type) VALUES (?, '', 'rider')");
    $stmt->bind_param("s", $rider_name);
    $stmt->execute();
    $user_id = $stmt->insert_id;
    $stmt->close();

    // Insert booking
    $stmt2 = $conn->prepare("INSERT INTO bookings (ride_id, user_id, booking_status) VALUES (?, ?, 'confirmed')");
    $stmt2->bind_param("ii", $ride_id, $user_id);
    $stmt2->execute();
    $stmt2->close();

    echo "<p>Booking confirmed!</p>";
}

// Fetch rides for dropdown
$rides_result = $conn->query("SELECT ride_id, destination FROM rides");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book a Ride</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Book a Ride</h1>
    <a href="index.php">Back to Ride Board</a>
</header>
<main>
<form method="POST">
    Rider Name: <input type="text" name="rider_name" required><br>
    Select Ride: 
    <select name="ride_id" required>
        <?php while($row = $rides_result->fetch_assoc()): ?>
            <option value="<?= $row['ride_id'] ?>"><?= $row['destination'] ?></option>
        <?php endwhile; ?>
    </select><br>
    <input type="submit" value="Book Ride">
</form>
</main>
<footer>&copy; 2026 CommuteBuddy</footer>
</body>
</html>