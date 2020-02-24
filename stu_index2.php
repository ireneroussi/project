<?php
require "connect.php";

if (isset($_POST["stu_login"])) {

	$stu_pass = mysqli_real_escape_string($conn, $_POST['stu_pass']);

	$stu_email = mysqli_real_escape_string($conn, $_POST['stu_email']);

	$sql = "SELECT `id`,`stu_email`,`stu_pass` FROM `students` WHERE `stu_email` = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {

		header("Location:stu_login.php?error=sqlerror");

		exit();

	}

	else{

		mysqli_stmt_bind_param($stmt,"s",$stu_email);

		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);

		$resultcheck = mysqli_num_rows($result);

		if ($resultcheck > 0) {

			while ($row = mysqli_fetch_assoc($result)) {

				$pwdcheck = password_verify($stu_pass, $row['stu_pass']);

				if ($pwdcheck == FALSE) {

					header("Location:stu_login.php?error=wrongpassword");

					exit();

					}

				else {

					if ($stu_email !== $row['stu_email']) {

						header("Location:stu_login.php?error=wrongemail");

						exit();

					}

					else {

						session_start();

						$_SESSION["fetchid"] = $row['id'];

						$_SESSION["stu_login"] = $row['stu_email'];

						header("Location:grades.php?login=success");

					}

				}

			}

		}

		else {

			header("Location:stu_login.php?error=userdoesnotexist");

		}

	}

}

else{

	header("Location:stu_login.php?error");

}

?>
