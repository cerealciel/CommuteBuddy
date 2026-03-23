<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM rides WHERE ride_id = $id");
$ride = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $seat_price = $_POST['seat_price'];

    $stmt = $conn->prepare("UPDATE rides SET destination=?, departure_time=?, seat_price=? WHERE ride_id=?");
    $stmt->bind_param("ssdi", $destination, $departure_time, $seat_price, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<main class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow">

<form method="POST" class="space-y-4">

<input name="destination" value="<?= $ride['destination'] ?>" class="w-full p-3 border rounded">
<input type="datetime-local" name="departure_time"
value="<?= date('Y-m-d\TH:i', strtotime($ride['departure_time'])) ?>"
class="w-full p-3 border rounded">

<input name="seat_price" value="<?= $ride['seat_price'] ?>" class="w-full p-3 border rounded">

<button class="w-full bg-blue-600 text-white p-3 rounded">Update</button>

</form>

</main>
</body>
</html>