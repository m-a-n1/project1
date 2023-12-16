<?php

include 'db_connect.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>
   <link rel="stylesheet" href="styleOfLogin.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

</head>
<body>

<nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">HOTEL WEBSITE</label>
        <ul class="ul0">
            <li><a class="active" href="index.html">HOME</a></li>
            <li><a href="profile.php">PROFILE</a></li>
            <li><a href="bb.php">BOOK</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
    </nav>
   
<div class="container12">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <h3><?php echo $fetch['email']; ?></h3>
      <a href="updateprofile.php" class="btn12">update profile</a>
      <a href="profile.php?logout=<?php echo $user_id; ?>" class="delete-btn12">logout</a>
      <p>new <a href="login.php">login</a> or <a href="signup.php">signup</a></p>
   </div>

</div>

<footer class="footer">
        <div class="container">
            <div class="footersection">
                <h4>THIS HOTEL</h4>
                <ul>
                    <li><a href="index.html">home page</a></li>
                    <li><a href="signup.php">signup</a></li>
                </ul>
            </div>
            <div class="footersection">
                <h4>CONTACT</h4>
                <ul>
                    <li><h5>phone number:</h5><p>055-555-5555</p></li>
                    <li><h5>email:</h5><p>fakeemail@gmail.com</p></li>
                </ul>
            </div>
            <div class="footersection">
                <h4>SOCIALS</h4>
                <ul>
                    <li><a href="https://twitter.com/">twitter</a></li>
                    <li><a href="https://www.instagram.com/">instagram</a></li>
                    <li><a href="https://www.facebook.com/">facebook</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>