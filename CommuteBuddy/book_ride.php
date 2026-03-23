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

    echo "<div class='max-w-xl mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded'>Booked!</div>";
}

$rides = $conn->query("SELECT ride_id, destination FROM rides");
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<header class="bg-white shadow p-4">
<a href="index.php">← Back</a>
</header>

<main class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow">

<form method="POST" class="space-y-4">

<input name="rider_name" placeholder="Your Name" class="w-full p-3 border rounded">

<select name="ride_id" class="w-full p-3 border rounded">
<?php while($r = $rides->fetch_assoc()): ?>
<option value="<?= $r['ride_id'] ?>"><?= $r['destination'] ?></option>
<?php endwhile; ?>
</select>

<button class="w-full bg-blue-600 text-white p-3 rounded">Book</button>

</form>

</main>
</body>
</html>