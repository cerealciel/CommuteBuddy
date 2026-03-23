<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CommuteBuddy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">

<header class="bg-white shadow sticky top-0">
    <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
        <h1 class="text-2xl font-bold text-blue-600">CommuteBuddy</h1>
        <nav class="space-x-6">
            <a href="index.php">Home</a>
            <a href="post_ride.php">Post Ride</a>
            <a href="book_ride.php">Book Ride</a>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto mt-10 px-4">

<h2 class="text-3xl font-bold mb-6">Available Rides</h2>

<?php
$sql = "SELECT rides.*, users.firstname, users.lastname 
        FROM rides 
        JOIN users ON rides.driver_id = users.user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="grid md:grid-cols-2 gap-6">';
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='bg-white p-5 rounded-2xl shadow'>

            <div class='flex justify-between'>
                <div>
                    <p class='font-semibold'>{$row['firstname']} {$row['lastname']}</p>
                </div>
                <span class='text-blue-600 font-bold'>₱ {$row['seat_price']}</span>
            </div>

            <p class='text-gray-600 mt-2'>Destination: {$row['destination']}</p>
            <p class='text-gray-600'>Departure: {$row['departure_time']}</p>

            <div class='mt-4 flex gap-2'>
                <a href='edit_ride.php?id={$row['ride_id']}'
                   class='flex-1 bg-yellow-500 text-white text-center py-2 rounded'>
                   Edit
                </a>

                <form method='POST' action='delete_ride.php' class='flex-1'>
                    <input type='hidden' name='ride_id' value='{$row['ride_id']}'>
                    <button class='w-full bg-red-500 text-white py-2 rounded'>
                        Delete
                    </button>
                </form>
            </div>

        </div>";
    }
    echo '</div>';
} else {
    echo "No rides available.";
}
?>

<h2 class="text-3xl font-bold mt-10 mb-6">Bookings</h2>

<?php
$sql = "SELECT bookings.*, users.firstname, rides.destination
        FROM bookings
        JOIN users ON bookings.user_id = users.user_id
        JOIN rides ON bookings.ride_id = rides.ride_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='grid md:grid-cols-2 gap-6'>";
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='bg-white p-5 rounded-2xl shadow flex justify-between'>

            <div>
                <p class='font-semibold'>{$row['firstname']}</p>
                <p class='text-gray-600 text-sm'>Destination: {$row['destination']}</p>
                <p class='text-green-600 text-sm'>{$row['booking_status']}</p>
            </div>

            <form method='POST' action='delete_booking.php'>
                <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                <button class='bg-red-500 text-white px-3 py-1 rounded'>
                    Delete
                </button>
            </form>

        </div>";
    }
    echo "</div>";
} else {
    echo "No bookings yet.";
}
?>

</main>
</body>
</html>