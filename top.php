<?php
    session_start();
    include('staff_config.php');
    include('function.php');
if(!isset($_SESSION['IS_LOGIN']))
{
    redirect('staff_login.html');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Links -->
  <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link" href="top.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="category.php">Category</a>
    </li>
       <li class="nav-item">
      <a class="nav-link" href="staff_user.php">User</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['ADMIN_USER']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="staff_logout.php">Logout</a>
        </div>
      </li>  
      
      
  </ul>

</nav>

</body>
</html>
