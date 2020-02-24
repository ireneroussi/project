<?php



require "connect.php";



if (isset($_POST["tea_submit"])) {

	$tea_name = mysqli_real_escape_string($conn, $_POST['tea_name']);

	$tea_surname = mysqli_real_escape_string($conn, $_POST['tea_surname']);

	$tea_pass= mysqli_real_escape_string($conn, $_POST['tea_pass']);

	$pswencr = password_hash($tea_pass, PASSWORD_DEFAULT);
  $tea_pass2= mysqli_real_escape_string($conn, $_POST['tea_pass2']);

	$tea_email = mysqli_real_escape_string($conn, $_POST['tea_email']);

	if ($tea_pass !== $tea_pass2) {

		header("Location:tea_signup.php?error=notmatchingpsw");

		exit();

		}

	else {

			$sql = "SELECT `tea_email` FROM `teachers` WHERE `tea_email` = ?;";

			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {

				header("Location:tea_signup.php?error=sqlerror");

				exit();

			}

			else{

				mysqli_stmt_bind_param($stmt,"s", $tea_email);

				mysqli_stmt_execute($stmt);

				mysqli_stmt_store_result($stmt);

				$sqlcheck = mysqli_stmt_num_rows($stmt);

				if ($sqlcheck >0) {

					header("Location:tea_signup.php?error=usertaken");

					exit();

				}

				else{

					$sql2 = "INSERT INTO `teachers`(`tea_name`,`tea_surname`,`tea_pass`,`tea_email`) VALUES (?,?,?,?);";

					$stmt1 = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt1,$sql2)) {

						echo 'Sql error';

						exit();

					}

					else{

						mysqli_stmt_bind_param($stmt1,"ssss", $tea_name, $tea_surname, $pswencr, $tea_email);

						mysqli_stmt_execute($stmt1);

						mysqli_stmt_store_result($stmt1);

						header("Location:tea_login.php?signup=success");

					}

				}

			}

	}

}

else{

	header("Location:tea_signup.php");

}

?>
