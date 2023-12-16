
<?php

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div href="bb.php" class="room-card">
                <div class="room-type">' . $row['room_type'] . '</div>
                <div class="room-price">السعر: ' . $row['price'] . '</div>
                <a href="bb.php" class="book-now" >احجز الان </a>
            </div>';
    }
} else {
    echo '<p>No results found.</p>';
}

?>


