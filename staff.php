<?php      
    include('staff_config.php');  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select username,password from staff_user where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
             
            $_SESSION['IS_LOGIN']='yes';
            header("location:developer.php");
        }  
        else{  
            echo "<center><h1 > Login failed. Invalid username or password.</h1> <br>
            <a href='staff.html'>Click here</a> to Login.</center>";
            
        }     
?>