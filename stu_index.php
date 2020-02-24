<?php



require "connect.php";



if (isset($_POST["stu_submit"])) {

	$stu_name = mysqli_real_escape_string($conn, $_POST['stu_name']);

	$stu_surname = mysqli_real_escape_string($conn, $_POST['stu_surname']);

	$stu_pass= mysqli_real_escape_string($conn, $_POST['stu_pass']);

	$pswencr = password_hash($stu_pass, PASSWORD_DEFAULT);
  $stu_pass2= mysqli_real_escape_string($conn, $_POST['stu_pass2']);

	$stu_email = mysqli_real_escape_string($conn, $_POST['stu_email']);

	if ($stu_pass !== $stu_pass2) {

		header("Location:stu_signup.php?error=notmatchingpsw");

		exit();

		}

	else {

			$sql = "SELECT `stu_email` FROM `students` WHERE `stu_email` = ?;";

			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {

				header("Location:stu_signup.php?error=sqlerror");

				exit();

			}

			else{

				mysqli_stmt_bind_param($stmt,"s", $stu_email);

				mysqli_stmt_execute($stmt);

				mysqli_stmt_store_result($stmt);

				$sqlcheck = mysqli_stmt_num_rows($stmt);

				if ($sqlcheck >0) {

					header("Location:stu_signup.php?error=usertaken");

					exit();

				}

				else{

					$sql2 = "INSERT INTO `students`(`stu_name`,`stu_surname`,`stu_pass`,`stu_email`) VALUES (?,?,?,?);";

					$stmt1 = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt1,$sql2)) {

						echo 'Sql error';

						exit();

					}

					else{

						mysqli_stmt_bind_param($stmt1,"ssss", $stu_name, $stu_surname, $pswencr, $stu_email);

						mysqli_stmt_execute($stmt1);

						mysqli_stmt_store_result($stmt1);

						header("Location:student_home.php?signup=success");

					}

				}

			}

	}

}

else{

	header("Location:stu_signup.php");

}

?>
