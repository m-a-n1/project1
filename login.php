<?php

include 'db_connect.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:profile.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
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

<div class="form-container12">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="logindecide">
      <button class="decidebtn"><a href="login.php">customer</a></button>
      <button class="decidebtn"><a href="adminlogin.php">administrator</a></button>
      </div>
      <input type="email" name="email" placeholder="enter email" class="box12" required>
      <input type="password" name="password" placeholder="enter password" class="box12" required>
      <input type="submit" name="submit" value="login now" class="btn12">
      <p>don't have an account? <a href="signup.php">signup now</a></p>
   </form>

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