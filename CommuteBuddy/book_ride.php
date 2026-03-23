<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ride_id = $_POST['ride_id'];
    $rider_name = $_POST['rider_name'];

    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, type) VALUES (?, '', 'rider')");
    $stmt->bind_param("s", $rider_name);
    $stmt->execute();
    $user_id = $stmt->insert_id;
    $stmt->close();

    $stmt2 = $conn->prepare("INSERT INTO bookings (ride_id, user_id, booking_status) VALUES (?, ?, 'confirmed')");
    $stmt2->bind_param("ii", $ride_id, $user_id);
    $stmt2->execute();
    $stmt2->close();

    echo "<div class='max-w-xl mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded'>Booking confirmed!</div>";
}

$rides_result = $conn->query("SELECT ride_id, destination FROM rides");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Ride</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<header class="bg-blue-600 text-white p-4 shadow">
    <div class="max-w-5xl mx-auto">
        <a href="index.php" class="underline">← Back</a>
    </div>
</header>

<main class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-xl shadow">

<h2 class="text-2xl font-semibold mb-4">Book a Ride</h2>

<form method="POST" class="space-y-4">

    <input type="text" name="rider_name" placeholder="Your Name"
        class="w-full p-2 border rounded">

    <select name="ride_id" class="w-full p-2 border rounded">
        <?php while($row = $rides_result->fetch_assoc()): ?>
            <option value="<?= $row['ride_id'] ?>">
                <?= $row['destination'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit"
        class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
        Book Ride
    </button>

</form>

</main>

</body>
</html>