<?php

session_start();

if (!isset($_SESSION["tea_login"])) {

    header("Location:tea_login.php?error=pnotloggedin");

};

if (isset($_GET['login'])) {

    if($_GET['login']=="success") {

        echo "<h2>Successfully login!</h2>";

     }

    else if ($_GET['gradeedit']=="success") {

        echo "<h2>Grades successfuly updated!</h2>";

     };

};

?>





<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/form.css">

    <title> Student Grades</title>

</head>

<body>

    <div class="container">

        <div class="form">

            <h2>Student grades!</h2>

            <form method="post" action="checkstud.php">

              <?php if (isset($_GET['error'])) {

                  if ($_GET['error']=="doesnotexist") { ?>

                  <p class="error">Student does not exist, try again!</p>

                  <?php }; }?>

            <input type="text" name="stu_name" placeholder="Student Name" required>

            <input type="text" name="stu_surname" placeholder="Student Surname" required>

            <input type="submit" name="submit" value="Search"> <br/> <br/>
            <?php

            if (isset($_SESSION["tea_login"])) {

                echo ' <a href="tea_logout.php">Log out</a>' ;

            };

            ?>
            </form>

        </div>

    </div>

</body>

</html>
