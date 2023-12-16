<?php

include 'db_connect.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_number = mysqli_real_escape_string($conn, $_POST['update_number']);

   mysqli_query($conn, "UPDATE `users` SET name = '$update_name', email = '$update_email', number = '$update_number' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'updated successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>
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
            <li><a class="active" href="/index.html">HOME</a></li>
            <li><a href="profile.php">PROFILE</a></li>
            <li><a href="/bb.php">BOOK</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
    </nav>
    
<div class="update-profile12">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post">
      <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message12">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex12">
         <div class="inputBox12">
            <h4>username :</h4>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box12">
            <h4>your email :</h4>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box12">
            <h4>number :</h4>
            <input type="tel" name="update_number" value="<?php echo $fetch['number']; ?>" class="box12">
         </div>
         <div class="inputBox12">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <h4>old password :</h4>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box12">
            <h4>new password :</h4>
            <input type="password" name="new_pass" placeholder="enter new password" class="box12">
            <h4>confirm password :</h4>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box12">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn12">
      <a href="profile.php" class="delete-btn12">go back</a>
   </form>

</div>

<footer class="footer">
        <div class="container">
            <div class="footersection">
                <h4>THIS HOTEL</h4>
                <ul>
                    <li><a href="/index.html">home page</a></li>
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