<?php
session_start();
include('staff_config.php');
unset($_SESSION['IS_LOGIN']);
header("location:staff.html");
?>