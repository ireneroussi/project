



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/form.css">

    <title>Sign up Student</title>

</head>

<body>

    <div class="container">

        <div class="form">

            <h2>Sign up Student!</h2>

            <form method="post" action="stu_index.php">
              <?php if (isset($_GET['error'])) {

                  if ($_GET['error']=="passwordnotmatching") { ?>

                      <p class="error">Passwords are not matching, try again!</p>

                  <?php } elseif ($_GET['error']=="usertaken") { ?>

                      <p class="error">User already exists!</p>

                  <?php };

              }?>

            <input type="text" name="stu_name" placeholder="Name" required>

            <input type="text" name="stu_surname" placeholder="Surname" required>

            <input type="email" name="stu_email" placeholder="Email" required>

            <input type="text" name="stu_pass" placeholder="Password" required>

            <input type="text" name="stu_pass2" placeholder="Repeat password" required>

            <input type="submit" value="Sign Up" name="stu_submit">
            <p> Already signed up?<a href="stu_login.php">Login</a> <br/>
              Are you a teacher? <a href="tea_signup.php">Signup for teachers</a> </p>

            </form>

        </div>

    </div>

</body>

</html>
