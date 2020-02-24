<?php

session_start();

unset($_SESSION["stu_login"]);

header("Location:stu_login.php");

?>
