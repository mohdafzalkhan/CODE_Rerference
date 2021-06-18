<?php
include('top.php');
$msg="";
$name="";
$mobile="";
$password="";
$id="";
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $id=get_safe_value($_GET['id']);
    $row =mysqli_fetch_assoc(mysqli_query($con,"SELECT * from delivery where id='$id'"));
    $name=$row['name'];
    $password=$row['password'];
    $mobile=$row['mobile'];
}
if(isset($_POST['submit'])){
    $name=get_safe_value($_POST['name']);
    $password=get_safe_value($_POST['password']);
    $mobile=get_safe_value($_POST['mobile']);
    $added_on=date('Y-m-d h:i:s');
    if($id=='')
    {
        
    $sql="SELECT * from delivery where mobile='$mobile'";
    }else
    {
         $sql="SELECT * from delivery where mobile='$mobile' and id!='$id'";
    }
    if(mysqli_num_rows(mysqli_query($con,$sql))>0)
    {
        $msg="Delivery Boy already exists.";
    }else{
         if($id=='')
    {
        
      
        mysqli_query($con,"INSERT INTO delivery(name,mobile,password,status,added_on) values ('$name','$mobile','$password',1,'$added_on')");
    }else
    {
           
        mysqli_query($con,"Update delivery set name='$name',mobile='$mobile',password='$password' where id='$id'");
         }
      
    header('location:delivery.php');
}
}

?>
<html>
<head>
<link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">    

    
</head>

    <body>
        <div class="card-body"><center>
            <h3 class="carg-title m110">Delivery Boy Manager</h3></center>
        <div class="col-12 grid-margin stretch-card">
            <div class="container">
                <div class ="card-body">
                    <form method="post">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name" required value="<?php echo $name ?>">
                        </div>
                        <p style="color:red;"><?php echo $msg ?></p>
                         <div class="form-group">
                        <label for="exampleFormControlInput1">Mobile Number:</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Enter Number" value="<?php echo $mobile ?>">
                             
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Password:</label>
                        <input type="text" class="form-control" name="password" placeholder="Enter Password" value="<?php echo $password ?>">
                             
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      </form>
                </div>
            </div>    
        </div>    
        </div>
        
    </body>
</html>
