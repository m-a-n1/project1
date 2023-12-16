<?php
include 'db_connect.php';

function checkRoomAvailability($conn, $room_id, $arrival_date, $departure_date, $num_rooms_requested)
{
    $stmt = $conn->prepare("SELECT SUM(num_rooms) AS booked_rooms FROM bookings 
                            WHERE room_id = ? 
                            AND NOT (departure_date < ? OR arrival_date > ?)");
    $stmt->bind_param("iss", $room_id, $arrival_date, $departure_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $booked_rooms = $result->num_rows > 0 ? $result->fetch_assoc()['booked_rooms'] : 0;

    $stmt_capacity = $conn->prepare("SELECT max_capacity FROM rooms WHERE room_id = ?");
    $stmt_capacity->bind_param("i", $room_id);
    $stmt_capacity->execute();
    $capacity_result = $stmt_capacity->get_result();
    if ($capacity_result->num_rows > 0) {
        $max_capacity = $capacity_result->fetch_assoc()['max_capacity'];
        return ($max_capacity - $booked_rooms) >= $num_rooms_requested;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $room_id = intval($_POST['room_id']);
    $arrival_date = mysqli_real_escape_string($conn, $_POST['arrival_date']);
    $departure_date = mysqli_real_escape_string($conn, $_POST['departure_date']);
    $num_rooms = intval($_POST['num_rooms']);

    if (checkRoomAvailability($conn, $room_id, $arrival_date, $departure_date, $num_rooms)) {
        $stmt = $conn->prepare("INSERT INTO bookings (name, email, room_id, arrival_date, departure_date, num_rooms) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissi", $name, $email, $room_id, $arrival_date, $departure_date, $num_rooms);
        if ($stmt->execute()) {
            echo "New booking record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Sorry, there are not enough available rooms for your request.";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>taibahu Hotel</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>


    <section class="tm-main">
        <p>الحجز</p>
    </section>

    <section class="tm-booking">
        <form action="bb.php" method="post">
            <input type="text" name="name" placeholder="الاسم" required>
            <input type="email" name="email" placeholder="الايميل" required>

            <label for="room_id">الغرف المتاحة :</label>
            <select name="room_id" id="room_id" required>
                <?php
                $sql = "SELECT room_id, room_type FROM rooms";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['room_id'] . "'>" . $row['room_type'] . "</option>";
                }
                ?>
            </select>

            <label for="arrival_date">موعد الوصول:</label>
            <input type="date" name="arrival_date" id="arrival_date" required>

            <label for="departure_date">موعد المغادرة:</label>
            <input type="date" name="departure_date" id="departure_date" required>

            <label for="num_rooms">عدد الغرف:</label>
            <select name="num_rooms" id="num_rooms" required>
                <?php for ($i = 1; $i <= 5; $i++) {  
                    echo "<option value='$i'>$i</option>";
                } ?>
            </select>

            <label for="num_guests">عدد الضيوف:</label>
            <select name="num_guests" id="num_guests" required>
                <?php for ($i = 1; $i <= 5; $i++) {  
                    echo "<option value='$i'>$i</option>";
                } ?>
            </select>

            <input type="submit" value="احجز الان">
        </form>
    </section>


    < <footer class="tm-footer">
        <div class="tm-us">
            <p class="bold">About Us</p>
            <p>>نحن جزء من سلسلة فنادق فاخرة
                والتي تمتد في جميع أنحاء المملكة العربية السعودية . نحن
                توفير إقامة فاخرة ذات قيمة مختلفة
                الخدمات المضافة والمجانية التي ستجعلك
                تقوم بزيارتنا مرارا وتكرارا.</p>
        </div>

        
        </footer>
</body>

</html>