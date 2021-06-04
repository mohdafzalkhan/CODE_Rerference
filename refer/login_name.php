<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="database123";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
//now check the connection
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());

}
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query = "SELECT * FROM `entry_details` WHERE email = '$email' AND password = '".$password. "' ";
    $result = mysqli_query($conn,$email);
    $rows = mysqli_num_rows ($result);
    if ($rows == 1){
        $_SESSION['email'] = $email ;
        header ("Location:index.html");
    }
    else
        echo "<h3>Incorrect Username or password";
    }
    else
    {
        $error = "Wrong Credentials";
    }