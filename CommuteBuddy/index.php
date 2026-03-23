<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CommuteBuddy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<header class="bg-blue-600 text-white p-4 shadow">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">CommuteBuddy</h1>
        <nav class="space-x-4">
            <a href="index.php" class="hover:underline">Home</a>
            <a href="post_ride.php" class="hover:underline">Post Ride</a>
            <a href="book_ride.php" class="hover:underline">Book Ride</a>
        </nav>
    </div>
</header>

<main class="max-w-5xl mx-auto mt-8 p-6 bg-white rounded-xl shadow">

<!-- RIDES -->
<h2 class="text-2xl font-semibold mb-4">Available Rides</h2>

<?php
$sql = "SELECT rides.*, users.firstname, users.lastname 
        FROM rides 
        JOIN users ON rides.driver_id = users.user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="grid gap-4">';
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='border rounded-lg p-4 shadow-sm hover:shadow-md'>

            <p class='font-semibold text-lg'>
                {$row['firstname']} {$row['lastname']}
            </p>

            <p class='text-gray-600'>Destination: {$row['destination']}</p>
            <p class='text-gray-600'>Departure: {$row['departure_time']}</p>

            <p class='text-blue-600 font-bold mt-2'>
                ₱ {$row['seat_price']} per seat
            </p>

            <div class='mt-3 flex gap-2'>

                <!-- EDIT BUTTON -->
                <a href='edit_ride.php?id={$row['ride_id']}'
                   class='bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600'>
                   Edit
                </a>

                <!-- DELETE BUTTON -->
                <form method='POST' action='delete_ride.php'>
                    <input type='hidden' name='ride_id' value='{$row['ride_id']}'>
                    <button class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600'>
                        Delete
                    </button>
                </form>

            </div>

        </div>";
    }
    echo '</div>';
} else {
    echo "<p class='text-gray-500'>No rides available.</p>";
}
?>

<!-- BOOKINGS -->
<h2 class="text-2xl font-semibold mt-8 mb-4">Bookings</h2>

<?php
$sql = "SELECT bookings.*, users.firstname, rides.destination
        FROM bookings
        JOIN users ON bookings.user_id = users.user_id
        JOIN rides ON bookings.ride_id = rides.ride_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='grid gap-4'>";
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='border rounded-lg p-4 shadow-sm flex justify-between items-center'>

            <div>
                <p><span class='font-semibold'>Rider:</span> {$row['firstname']}</p>
                <p><span class='font-semibold'>Destination:</span> {$row['destination']}</p>
                <p class='text-green-600 font-bold'>Status: {$row['booking_status']}</p>
            </div>

            <form method='POST' action='delete_booking.php'>
                <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                <button class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600'>
                    Delete
                </button>
            </form>

        </div>";
    }
    echo "</div>";
} else {
    echo "<p class='text-gray-500'>No bookings yet.</p>";
}
?>

</main>

</body>
</html>