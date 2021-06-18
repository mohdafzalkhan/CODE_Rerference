<?php
include('top.php');
$msg="";
$category_id="";
$dish="";
$dish_details="";
$image="";
$id="";
$image_status='required';
$image_error="";

if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $id=get_safe_value($_GET['id']);
    $row =mysqli_fetch_assoc(mysqli_query($con,"SELECT * from dish where id='$id'"));
    $category_id=$row['category_id'];
    $dish=$row['dish'];
    $dish_details=$row['dish_details'];
    $image=$row['image'];
}
if(isset($_POST['submit'])){
    $category_id=get_safe_value($_POST['category_id']);
    $dish=get_safe_value($_POST['dish']);
    $dish_details=get_safe_value($_POST['dish_details']);
    $added_on=date('Y-m-d h:i:s');
    if($id==''){
    $sql="SELECT * from dish where dish='$dish'";
    }else{
         $sql="SELECT * from dish where dish='$dish' and id!='$id'";
    }
    if(mysqli_num_rows(mysqli_query($con,$sql))>0)
    {
        $msg="Dish already exists.";
    }else{
    $type=$_FILES['image']['type'];
    if($id==''){   
    if($type!='image/jpeg' && $type!='image/png'){
    $image_error="Invalid Image Format";
    }else{
    $image=$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],SERVER_DISH_IMAGE.$_FILES['image']['name']);   

    mysqli_query($con,"INSERT INTO dish(category_id,dish,dish_details,status,added_on,image) values ('$category_id','$dish','$dish_details',1,'$added_on','$image')");
         header('location:dish.php');
    }
    }else{       
    $image_condition='';
    if($_FILES['image']['types']!=''){
        if($type!='image/jpeg' && $type!='image/png'){
                 $image_error="Invalid Image Format";
             }else{
                $image=$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],SERVER_DISH_IMAGE.$_FILES['image']['name']); 
                $image_condition=", image='$image'";
    }
    }
        if($image_error==''){
    $sql="update dish set category_id='$category_id, dish='$dish',dish_details='$dish_details',$image_condition'where id='$id'";
    mysqli_query($con,$sql);
             header('location:dish.php');
        }
    }
    }
    }
   
$res_category=mysqli_query($con,"SELECT * from food_category where status='1' order by category desc");
?>
<html>
<head>
<link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">    

    
</head>

    <body>
        <div class="card-body"><center>
            <h3 class="carg-title m110">Dish Manager</h3></center>
        <div class="col-12 grid-margin stretch-card">
            <div class="container">
                <div class ="card-body">
                    <form method="post" enctype="multipart/form-data" class="forms-sample">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Category</label>
                        <select class="form-control" name="category_id">
                            <option value="">Select Category</option>
                            <?php
                            while($row_category=mysqli_fetch_assoc($res_category)){
                                if($row_category['id']==$category_id)
                                {
                                    echo "<option value='".$row_category['id']."' selected>".$row_category['category']."<option>";
                            
                                }
                                else{
                                echo "<option value='".$row_category['id']."'>".$row_category['category']."<option>";
                            }
                            }
                            ?>
                        </select>
                        </div>
                        <p style="color:red;"><?php echo $msg ?></p>
                         <div class="form-group">
                        <label for="exampleFormControlInput1">Dish:</label>
                        <input type="text" class="form-control" required name="dish" placeholder="Enter Dish Name" value="<?php echo $dish ?>">   
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Dish Details</label>
                        <textarea name="dish_details" class="form-control" placeholder="Enter details"><?php echo $dish_details?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Dish Image:</label>
                        <input type="file" class="form-control" name="image" placeholder="Upload Dish Image" <?php echo $image_status ?> >   
                        </div>
                        <div class="error mt8" style="color:red;"><?php echo $image_error?></div>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      </form>
                </div>
            </div>    
        </div>    
        </div>
        
    </body>
</html>
