
<?php



require "connect.php";



if (isset($_POST["tea_login"])) {

	$tea_pass = mysqli_real_escape_string($conn, $_POST['tea_pass']);

	$tea_email = mysqli_real_escape_string($conn, $_POST['tea_email']);

	$query = "SELECT `tea_email`,`tea_pass` FROM `teachers` WHERE `tea_email` = ?";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$query)) {

		header("Location:tea_login.php?error=sqlerror");

		exit();

	}

	else{

		mysqli_stmt_bind_param($stmt,"s",$tea_email);

		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);

		$resultcheck = mysqli_num_rows($result);

		if ($resultcheck > 0) {

			while ($row = mysqli_fetch_assoc($result)) {

				$pswdcheck = password_verify($tea_pass, $row['tea_pass']);

				if ($pswdcheck == FALSE) {

					header("Location:tea_login.php?error=wrongpassword");

					exit();

					}

				else {

					if ($tea_email !== $row['tea_email']) {

						header("Location:tea_login.php?error=wrongemail");

						exit();

					}

					else {

						session_start();

						$_SESSION["tea_login"] = $row['tea_email'];

						header("Location:check.php?login=success");

					}

				}

			}

		}

	else {

		header("Location:tea_login.php?error=userdoesnotexist");

	}

	}

}

else{

	header("Location:tea_login.php");

}



?>
