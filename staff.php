<?php      
session_start();    
include('staff_config.php');
    include('function.php');
    $username = get_safe_value($_POST['username']);  
    $password = get_safe_value($_POST['password']);  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select * from staff_user where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);    
          
        if(mysqli_num_rows($result) >0){  
            $row=mysqli_fetch_assoc($result);
            $_SESSION['IS_LOGIN']='yes';
            $_SESSION['ADMIN_USER']=$row['name'];
            redirect('developer.php');
            die();
        }  
        else{  
            echo "<center><h1 > Login failed. Invalid username or password.</h1> <br>
            <a href='staff_login.html'>Click here</a> to Login.</center>";
            
        }     
?>