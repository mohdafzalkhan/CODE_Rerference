<?php
session_start();
include('function.php');
unset($_SESSION['FOOD_USER_ID']);
unset($_SESSION['FOOD_USER_NAME']);
redirect('shop.php');
?>
