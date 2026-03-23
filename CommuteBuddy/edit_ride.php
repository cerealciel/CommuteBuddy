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
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Ride</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<main class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-xl shadow">

<h2 class="text-2xl font-semibold mb-4">Edit Ride</h2>

<form method="POST" class="space-y-4">

    <input type="text" name="destination"
        value="<?= $ride['destination'] ?>"
        class="w-full p-2 border rounded">

    <input type="datetime-local" name="departure_time"
        value="<?= date('Y-m-d\TH:i', strtotime($ride['departure_time'])) ?>"
        class="w-full p-2 border rounded">

    <input type="number" step="0.01" name="seat_price"
        value="<?= $ride['seat_price'] ?>"
        class="w-full p-2 border rounded">

    <button type="submit"
        class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
        Update Ride
    </button>

</form>

</main>

</body>
</html>