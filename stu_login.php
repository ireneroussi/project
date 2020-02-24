


<?php
require "connect.php";


if (isset($_GET['signup'])) {

    if ($_GET['signup']=="success") {

          echo "<h2>Successfully signed up!</h2>";

    };

 };



?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Login</title>
</head>
<body>
    <div class="container">

        <div class="form">

            <h2>Login  Student!</h2>

           <form method="post" action="stu_index2.php">
             <?php if (isset($_GET['error'])) {

                 if ($_GET['error']=="wrongpassword") { ?>

                     <p class="error">Wrong password, try again!</p>

                 <?php } elseif ($_GET['error']=="wrongemail") { ?>

                     <p class="error">Wrong email, try again!</p>

                 <?php } elseif ($_GET['error']=="snotloggedin") { ?>

                     <p class="error">You are not logged in!</p>

                 <?php } elseif ($_GET['error']=="nogrades") { ?>

                     <p class="error">No grades yet, patience!</p>

                 <?php } elseif ($_GET['error']=="userdoesnotexist") { ?>

                     <p class="error">User does not exist!</p>

                 <?php };

             }?>


           <input type="email" name="stu_email" placeholder="Email" required>

           <input type="text" name="stu_pass" placeholder="Password" required>

           <input type="submit" value="Log In" name=" stu_login ">
           <p> Not signed up yet?<a href="stu_signup.php">Login</a> <br/>
             Are you a teacher? <a href="tea_login.php">Login for teachers</a> </p>
            

             </form>
        </div>
    </div>
</body>
</html>
