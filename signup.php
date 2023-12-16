<?php
include 'db_connect.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE 
   email = '$email'")
   or die('query failed');

   if(mysqli_num_rows($select) > 0){
    $message[] = 'user already exist'; 
 }else{
    if($pass != $cpass){
       $message[] = 'confirm password not matched!';
    }else{
       $insert = mysqli_query($conn, "INSERT INTO `users`(name, email, password, phone) VALUES('$name', '$email', '$pass', '$phone')") or die('query failed');
       if($insert){
        $message[] = 'signedup successfully!';
     }else{
        $message[] = 'signup failed!';
     }

}
}
}
$a = ' login now';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
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
        <h3>signup now</h3>
        <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">' .$message. '<a href="login.php">' .$a. '</a>' . '</div>';
         }
      }
      ?>
            <input type="text" name="name" placeholder="enter name" class="box12" required>
            <input type="email" name="email" placeholder="enter email" class="box12" required>
            <input type="password" name="password" placeholder="enter password" class="box12" required>
            <input type="password" name="cpassword" placeholder="confirm password" class="box12" required>
            <input type="tel" name="phone" placeholder="enter phone" class="box12" required>
            <input type="submit" name="submit" value="register now" class="btn12">
            <p>already have an account? <a href="login.php">login now</a></p>
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