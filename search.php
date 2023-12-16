<?php


include 'db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Search</title>
    <link rel="stylesheet" href="searchStyles.css">
    
</head>

<body>

    <header>
        <h1>ابحث عن الغرفه المناسبة</h1>
    </header>

    <section>
        <form action="search.php" method="post">
            <label for="roomType">اختر نوع الغرفه:</label>
            <select name="roomType" id="roomType">
                <option value="All_types">جميع الانواع </option>
                <option value="جناح فاخر">جناح فاخر</option>
                <option value="جناح ديلوكس">جناح ديلوكس</option>
                <option value="غرفة فاخرة">غرفة فاخرة</option>
            </select>

            <button id= "submit"type="submit">ابحث</button>
        </form>

        <div id="searchResults">
            <?php
            
            if (isset($_POST['roomType'])) {
               
                $roomType = $_POST['roomType'];
                 // نشيك اذا اختار جميع الانواع او نوع محدد 
                if ($roomType == "All_types") {
                    $sql = "SELECT DISTINCT room_type, price FROM rooms";
                    $result = $conn->query($sql);
                    include "searchResults.php";
                } else {
                    // نجلب السعر ونوع الغرفة من قاعدة البيانات
                    $sql = "SELECT room_type, price FROM rooms WHERE room_type = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $roomType);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    include "searchResults.php";

                $stmt->close();
                }

                if (!$result) {
                    die('Error: ' . $conn->error);
                }
        
            } 

          
            $conn->close();

            ?>
        </div>
    </section>
    
</body>

</html>