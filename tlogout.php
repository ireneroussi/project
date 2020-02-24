<?php

session_start();

unset($_SESSION["tea_login"]);

header("Location:tea_login.php");

?>
