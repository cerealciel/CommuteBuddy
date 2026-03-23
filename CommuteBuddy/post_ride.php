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

    echo "<div class='max-w-xl mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded'>Ride posted successfully!</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Ride</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js" defer></script>
</head>

<body class="bg-gray-100">

<header class="bg-blue-600 text-white p-4 shadow">
    <div class="max-w-5xl mx-auto">
        <a href="index.php" class="underline">← Back</a>
    </div>
</header>

<main class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-xl shadow">

<h2 class="text-2xl font-semibold mb-4">Post a Ride</h2>

<form method="POST" class="space-y-4">

    <input type="text" name="firstname" placeholder="First Name"
        class="w-full p-2 border rounded">

    <input type="text" name="lastname" placeholder="Last Name"
        class="w-full p-2 border rounded">

    <input type="text" name="destination" placeholder="Destination"
        class="w-full p-2 border rounded">

    <input type="datetime-local" name="departure_time"
        class="w-full p-2 border rounded">

    <input type="number" name="total_gas" id="total_gas" placeholder="Total Gas Cost"
        class="w-full p-2 border rounded">

    <input type="number" name="seats" id="seats" placeholder="Seats Available"
        class="w-full p-2 border rounded">

    <div class="bg-gray-100 p-3 rounded">
        Suggested Price per Seat:
        <span id="price_display" class="font-bold text-blue-600">0.00</span>
    </div>

    <button type="submit"
        class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
        Post Ride
    </button>

</form>

</main>

</body>
</html>