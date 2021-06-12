<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="index.html"><img src='res/logo.jpeg' alt="Logo" style="width:40px;"></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      
        <a class="nav-link" href="index.html">HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">SIGN IN</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactus.html">CONTACT US</a>
      <li class="nav-item">
        <a class="nav-link" href="gallery.html">GALLERY</a>
      <li class="nav-item">
        <a class="nav-link" href="register.php">SIGN UP</a>
      </li>
    </ul>
  </div>
</nav>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>