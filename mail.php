<?php
    session_start();
    include('staff_config.php');
    include('function.php');
    include('constant.php');
$name=get_safe_value($_POST['name']);
$email=get_safe_value($_POST['email']);
$mobile=get_safe_value($_POST['mobile']);
$subject=get_safe_value($_POST['subject']);
$message=get_safe_value($_POST['message']);
$added_on=date('Y-m-d h:i:s');
mysqli_query($con,"INSERT into contactus(name,email,mobile,subject,message,added_on) values('$name','$email','$mobile','$subject','$message','$added_on')");
echo "<script>
alert('THANKS FOR CONTACTING. WE WILL GET BACK TO YOU SHORTLY!');
window.location.href='contactus.php';
</script>";
//header('location:contactus.php');
?>