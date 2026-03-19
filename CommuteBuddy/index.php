<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CommuteBuddy - Ride Board</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>CommuteBuddy</h1>
    <nav>
        <a href="post_ride.php">Post a Ride</a> | 
        <a href="book_ride.php">Book a Ride</a>
    </nav>
</header>
<main>
<h2>Available Rides</h2>
<?php
$sql = "SELECT rides.ride_id, rides.destination, rides.departure_time, rides.seat_price, users.firstname, users.lastname
        FROM rides JOIN users ON rides.driver_id = users.user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'><tr><th>Driver</th><th>Destination</th><th>Departure</th><th>Price per Seat</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['firstname']} {$row['lastname']}</td>
                <td>{$row['destination']}</td>
                <td>{$row['departure_time']}</td>
                <td>{$row['seat_price']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No rides available.";
}
?>
</main>
<footer>
    &copy; 2026 CommuteBuddy
</footer>
</body>
</html>