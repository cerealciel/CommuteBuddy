<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $total_gas = $_POST['total_gas'];
    $seats = $_POST['seats'];

    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, type) VALUES (?, ?, 'driver')");
    $stmt->bind_param("ss", $firstname, $lastname);
    $stmt->execute();
    $driver_id = $stmt->insert_id;
    $stmt->close();

    $seat_price = $total_gas / $seats;

    $stmt2 = $conn->prepare("INSERT INTO rides (driver_id, destination, departure_time, seat_price) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("issd", $driver_id, $destination, $departure_time, $seat_price);
    $stmt2->execute();
    $stmt2->close();

    echo "<div class='max-w-xl mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded'>Ride posted!</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<script src="script.js" defer></script>
</head>
<body class="bg-gray-100">

<header class="bg-white shadow p-4">
<a href="index.php">← Back</a>
</header>

<main class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow">

<form method="POST" class="space-y-4">

<input name="firstname" placeholder="First Name" class="w-full p-3 border rounded">
<input name="lastname" placeholder="Last Name" class="w-full p-3 border rounded">
<input name="destination" placeholder="Destination" class="w-full p-3 border rounded">
<input type="datetime-local" name="departure_time" class="w-full p-3 border rounded">
<input id="total_gas" name="total_gas" placeholder="Gas Cost" class="w-full p-3 border rounded">
<input id="seats" name="seats" placeholder="Seats" class="w-full p-3 border rounded">

<p>Price per seat: <span id="price_display">0.00</span></p>

<button class="w-full bg-blue-600 text-white p-3 rounded">Post Ride</button>

</form>

</main>
</body>
</html>