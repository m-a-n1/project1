<?php
include 'db_connect.php';

$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["room_id"] . " - Type: " . $row["room_type"] . " - Price: " . $row["price"] . "<br>";
    }
} else {
    echo "0 results found. Please check if the 'rooms' table is populated.";
}
$conn->close();

