<?php
    session_start();
    include('staff_config.php');
    include('function.php');
    include('constant.php');
$currStr=$_SERVER['REQUEST_URI'];
$currArr=explode('/',$currStr);
$curr_path=$currArr[count($currArr)-1];
if(!isset($_SESSION['IS_LOGIN']))
{
    redirect('staff_login.html');
}
$page_title='';
if($curr_path=='' || $curr_path=='developer.php')
{
 $page_title='Dashboard';   
}elseif($curr_path=='category.php' || $curr_path=='Manage_category.php'){
    $page_title='Category';
}elseif($curr_path=='staff_user.php'){
    $page_title='Users';
}elseif($curr_path=='delivery.php'|| $curr_path=='Manage_deliver_boy.php'){
    $page_title='Delivery';
}elseif($curr_path=='coupon.php' || $curr_path=='manage_coupon.php'){
    $page_title='Coupon';
}elseif($curr_path=='dish.php'|| $curr_path=='manage_dish.php'){
    $page_title='Dish';
}elseif($curr_path=='banner.php'|| $curr_path=='manage_banner.php'){
    $page_title='Banner';
}elseif($curr_path==''){
    $page_title='Dashboard';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $page_title.'-'.SITE_NAME ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Links -->
  <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link fas fa-cloud" href="developer.php">Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link fas fa-file-alt" href="category.php">Category</a>
        </li>
        <li class="nav-item">
        <a class="nav-link 	fas fa-user-alt" href="staff_user.php">User</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="delivery.php">Delivery</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="coupon.php">Coupon Code</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="dish.php">Dish</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="banner.php">Banner</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php">Public Site</a>
        </li>
      
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['ADMIN_USER']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="staff_logout.php">Logout <p class="fas fa-power-off"></p></a>
        </div>
      </li>  
      
      
  </ul>

</nav>

</body>
</html>
