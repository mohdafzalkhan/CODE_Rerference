<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
SGN UP
</title>
<link rel = "stylesheet" href="signup.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<Body>
<form  method="post" id="user_register">
<div class="container">
<h1>Sign Up</h1>
<p>Please fill in this form to create an account.</p>
<hr> 
<div class="form-group">
<label>Name</label>
<input type="text" name="name" id="name" placeholder= "Enter name" class="form-control" required>
</div>
<div class="form-group">
<label>Email</label>
<input type="email" name="email" id="email" placeholder= "Enter email" class="form-control" required>
</div> 
<div class="form-group">
<label>Mobile</label>
<input type="text" name="mobile" id="mobile" placeholder= "Enter mobile Number" class="form-control" required>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required>
</div>
<div class="clearfix">
<button type="submit" class="signupbtn" id="register_button">Sign Up</button>
</div>
</div>
</form>
</Body>
</html>