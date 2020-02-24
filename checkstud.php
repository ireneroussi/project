<?php



require_once "connect.php";

session_start();



$onlyone = '';

$_SESSION['onlyone']=$onlyone;



if (!isset($_SESSION["tea_login"])) {

	   header("Location:tea_login.php?error=pnotloggedin");

	};

if (isset($_POST['submit'])) {

	$stu_name = mysqli_real_escape_string($conn,$_POST['stu_name']);

	$stu_surname = mysqli_real_escape_string($conn,$_POST['stu_surname']);

	$query = "SELECT grades.`subj1`, grades.`subj2`, grades.`subj3`, grades.`subj4` FROM `students` JOIN `grades` ON grades.`stu_id` = students.`id`  WHERE `stu_name` LIKE CONCAT('%',?,'%') AND `stu_surname` LIKE CONCAT('%',?,'%');";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$query)) {

		header("Location:check.php?error=sqlerror");

		exit();

	}

	else{

		mysqli_stmt_bind_param($stmt,"ss",$stu_name,$stu_surname);

		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);

		$resultcheck = mysqli_num_rows($query);

		if ($resultcheck > 0) {

			while ($row = mysqli_fetch_assoc($result)) {

   			$subj1 = $row['subj1'];

				$subj2 = $row['subj2'];

				$subj3 = $row['subj3'];

				$subj4 = $row['subj4'];

   			};

   		}

		else{

			$query2 = "SELECT `id` FROM `students` WHERE `stu_name` LIKE CONCAT('%',?,'%') AND `stu_surname` LIKE CONCAT('%',?,'%');";

			$stmt1 = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt1,$query2)) {

				header("Location:check.php?error=sqlerror");

				exit();

			}

				else{

					mysqli_stmt_bind_param($stmt1,"ss",$stu_name,$stu_surname);

					mysqli_stmt_execute($stmt1);

					$result1 = mysqli_stmt_get_result($stmt1);

					$resultcheck1 = mysqli_num_rows($query2);

					if ($resultcheck1 > 0) {

						while ($row = mysqli_fetch_assoc($result1)){

							session_start();

							$_SESSION["id"] = $row['id'];

							$onlytwo = '';

							$_SESSION['onlytwo'] = $onlytwo;

						};

							header("Location:update.php");

					}

					else{

						header("Location:check.php?error=doesnotexist");

					}

				}

		}

	}

}

else{

	header("Location:check.php");

};



echo '<h2><a href="check.php"> Search again! </a> </h2>';

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">

    <title>Grades</title>

</head>

<body>

    <main>

        <div class="container">

            <a> Subject one: <?php echo $subj1?> </a>

            <a> Subject two: <?php echo $subj2?> </a>

            <a> Subject three: <?php echo $subj3?> </a>

            <a> Subject four: <?php echo $subj4?> </a>

        </div>

    </main>

</body>

</html>



<?php echo "<h2><a href='tea_logout.php'>Log out </a> </h2>"; ?>
