<?php
session_start();
include('staff_config.php');
include('function.php');
unset($_SESSION['IS_LOGIN']);
redirect('staff_login.html');
?>