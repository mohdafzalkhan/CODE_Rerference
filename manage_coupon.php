<?php
include('top.php');
$msg="";
$coupon_code="";
$coupon_type="";
$coupon_value="";
$cart_min_value="";
$expired_on="";
$id="";
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $id=get_safe_value($_GET['id']);
    $row =mysqli_fetch_assoc(mysqli_query($con,"SELECT * from coupon_code where id='$id'"));
    $coupon_code=$row['coupon_code'];
    $coupon_type=$row['coupon_type'];
    $coupon_value=$row['coupon_value'];
    $cart_min_value=$row['cart_min_value'];
    $expired_on=$row['expired_on'];
}
if(isset($_POST['submit'])){
    $coupon_code=get_safe_value($_POST['coupon_code']);
    $coupon_type=get_safe_value($_POST['coupon_type']);
    $coupon_value=get_safe_value($_POST['coupon_value']);
    $cart_min_value=get_safe_value($_POST['cart_min_value']);
    $expired_on=get_safe_value($_POST['expired_on']);
    $added_on=date('Y-m-d h:i:s');
    if($id=='')
    {
        
    $sql="SELECT * from coupon_code where coupon_code='$coupon_code'";
    }else
    {
         $sql="SELECT * from coupon_code where coupon_code='$coupon_code' and id!='$id'";
    }
    if(mysqli_num_rows(mysqli_query($con,$sql))>0)
    {
        $msg="Coupon already exists.";
    }else{
         if($id=='')
    {
        
      
        mysqli_query($con,"INSERT INTO coupon_code(coupon_code,coupon_type,coupon_value,cart_min_value,expired_on,status,added_on) values ('$coupon_code','$coupon_type','$coupon_value','$cart_min_value','$expired_on',1,'$added_on')");
    }else
    {
           
        mysqli_query($con,"Update coupon_code set coupon_code='$coupon_code',coupon_type='$coupon_type',coupon_value='$coupon_value',cart_min_value='$cart_min_value',expired_on='$expired_on' where id='$id'");
         }
      
    header('location:coupon.php');
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
                        <label for="exampleFormControlInput1">Coupon Code:</label>
                        <input type="text" class="form-control" name="coupon_code" placeholder="Enter Coupon Code" required value="<?php echo $coupon_code ?>">
                        </div>
                        <p style="color:red;"><?php echo $msg ?></p>
                         <div class="form-group">
                        <label for="exampleFormControlInput1">Coupon Type:</label>
                        <select name="coupon_type" class="form-control" required>
                             <option value="">Select Type</option>
                            <?php
                            $arr=array('P'=>'Percentage','F'=>'Fixed');
                               foreach($arr as $key=>$val){
                                   if($key==$coupon_type)
                                   {
                                    
                                       echo "<option value='".$key."'selected>".$val."</option> ";
                                   }else{
                                       echo "<option value='".$key."'>".$val."</option> ";
                                   }
                               }
                            ?>
                         </select>
                        </div>
                         <div class="form-group">
                        <label for="exampleFormControlInput1">Coupon Value:</label>
                        <input type="text" class="form-control" name="coupon_value" placeholder="Enter Coupon value" value="<?php echo $coupon_value ?>">                             
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Minimum Cart Value:</label>
                        <input type="text" class="form-control" name="cart_min_value" placeholder="Enter Minimum cart value" value="<?php echo $cart_min_value ?>">                             
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Expired Date:</label>
                        <input type="date" class="form-control" name="expired_on" placeholder="Enter Expiry date" value="<?php echo $expired_on ?>">                             
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      </form>
                </div>
            </div>    
        </div>    
        </div>
        
    </body>
</html>
