


<?php



require "connect.php";

session_start();



if (!isset($_SESSION["stu_login"])) {

    header("Location:stu_login.php?error=notloggedin");

};



$id = $_SESSION["fetchid"];

$sql = mysqli_real_escape_string($conn,$id);

$query = "SELECT `subj1`, `subj2`, `subj3`, `subj4` FROM `grades` WHERE `student_id` LIKE CONCAT('%',?,'%') ;";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt,$query)) {

    header("Location:stu_index2.php?error=sqlerror");

    exit();

}

else{

    mysqli_stmt_bind_param($stmt,"s",$sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $resultcheck = mysqli_num_rows($result);

    if ($resultcheck > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

                $subj1 = $row['subj1'];

                $subj2 = $row['subj2'];

                $subj3 = $row['subj3'];

                $subj4 = $row['subj4'];



        }

    }

    else{

        header("Location:stu_login.php?error=nogrades");

        }

} ?>
