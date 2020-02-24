<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/form.css">

    <title>Sign up teacher</title>

</head>

<body>

    <div class="container">

        <div class="form">

            <h2>teacher's sign up!</h2>

            <form method="post" action="tea_index.php">
              <?php if (isset($_GET['error'])) {

                  if ($_GET['error']=="passwordnotmatching") { ?>

                      <p class="error">Passwords are not matching, try again!</p>

                  <?php } elseif ($_GET['error']=="usertaken") { ?>

                      <p class="error">User already exists!</p>

                  <?php };

              }?>

            <input type="text" name="tea_name" placeholder="Name" required>

            <input type="text" name="tea_surname" placeholder="Surname" required>

            <input type="email" name="tea_email" placeholder="Email" required>

            <input type="text" name="tea_pass" placeholder="Password" required>

            <input type="text" name="tea_pass2" placeholder="Repeat password" required>

            <input type="submit" value="Sign Up" name="tea_submit">
            <p> Already signed up?<a href="tea_login.php">Login</a> <br/>
              Are you a student? <a href="stu_signup.php">Signup for students</a> </p>

            </form>

        </div>

    </div>

</body>

</html>
