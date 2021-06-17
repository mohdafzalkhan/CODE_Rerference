<?php
include('top.php');
$msg="";
$category="";
$order_number="";
$id="";
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $id=get_safe_value($_GET['id']);
    $row =mysqli_fetch_assoc(mysqli_query($con,"SELECT * from food_category where id='$id'"));
    $category=$row['category'];
    $order_number=$row['order_number'];
}
if(isset($_POST['submit'])){
    $category=get_safe_value($_POST['category']);
    $order_number=get_safe_value($_POST['order_number']);
    $added_on=date('Y-m-d h:i:s');
    if($id=='')
    {
        
    $sql="SELECT * from food_category where category='$category'";
    }else
    {
         $sql="SELECT * from food_category where category='$category' and id!='$id'";
    }
    if(mysqli_num_rows(mysqli_query($con,$sql))>0)
    {
        $msg="Category already exists.";
    }else{
         if($id=='')
    {
        
      
        mysqli_query($con,"INSERT INTO food_category(category,order_number,status,added_on) values ('$category','$order_number',1,'$added_on')");
    }else
    {
           
        mysqli_query($con,"Update food_category set category='$category',order_number='$order_number' where id='$id'");
         }
      
    header('location:category.php');
}
}

?>
<html>
<head>
<link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">    

    
</head>

    <body>
        <div class="card-body"><center>
            <h3 class="carg-title m110">Category Manager</h3></center>
        <div class="col-12 grid-margin stretch-card">
            <div class="container">
                <div class ="card-body">
                    <form method="post">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Category name:</label>
                        <input type="text" class="form-control" name="category" placeholder="category" required value="<?php echo $category ?>">
                        </div>
                        <p style="color:red;"><?php echo $msg ?></p>
                         <div class="form-group">
                        <label for="exampleFormControlInput1">Order Number:</label>
                        <input type="text" class="form-control" name="order_number" placeholder="order number" value="<?php echo $order_number ?>">
                             
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      </form>
                </div>
            </div>    
        </div>    
        </div>
        
    </body>
</html>
