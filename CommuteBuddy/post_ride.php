<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $total_gas = $_POST['total_gas'];
    $seats = $_POST['seats'];

    // Insert driver into users table
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, type) VALUES (?, ?, 'driver')");
    $stmt->bind_param("ss", $firstname, $lastname);
    $stmt->execute();
    $driver_id = $stmt->insert_id;
    $stmt->close();

    $seat_price = $total_gas / $seats;

    // Insert ride
    $stmt2 = $conn->prepare("INSERT INTO rides (driver_id, destination, departure_time, seat_price) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("issd", $driver_id, $destination, $departure_time, $seat_price);
    $stmt2->execute();
    $stmt2->close();

    echo "<p>Ride posted successfully!</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Post a Ride</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<header>
    <h1>Post a Ride</h1>
    <a href="index.php">Back to Ride Board</a>
</header>
<main>
<form method="POST">
    First Name: <input type="text" name="firstname" required><br>
    Last Name: <input type="text" name="lastname" required><br>
    Destination: <input type="text" name="destination" required><br>
    Departure Time: <input type="datetime-local" name="departure_time" required><br>
    Total Gas Cost: <input type="number" name="total_gas" id="total_gas" required><br>
    Seats Available: <input type="number" name="seats" id="seats" required><br>
    Suggested Price per Seat: <span id="price_display">0.00</span><br>
    <input type="submit" value="Post Ride">
</form>
</main>
<footer>&copy; 2026 CommuteBuddy</footer>
</body>
</html>