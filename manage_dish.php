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
if(isset($_GET['dish_details_id']) && $_GET['dish_details_id'] >0)
{
    $dish_details_id=get_safe_value($_GET['dish_details_id']);
    $id=get_safe_value($_GET['id']);
    mysqli_query($con,"DELETE from dish_details where id='$dish_details_id'");
    redirect('manage_dish.php?id='.$id);
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
        if(mysqli_num_rows(mysqli_query($con,$sql))>0){
            $msg="Dish already exists.";
        }else{
            $type=$_FILES['image']['type'];
            if($id=='')
            {   
                if($type!='image/jpeg' && $type!='image/png'){
                    $image_error="Invalid Image Format";
                }else{
                    $image=$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],SERVER_DISH_IMAGE.$_FILES['image']['name']);
                    mysqli_query($con,"INSERT INTO dish(category_id,dish,dish_details,status,added_on,image) values ('$category_id','$dish','$dish_details',1,'$added_on','$image')");
                    //Adding Dish Details
                    $did=mysqli_insert_id($con);
                    $attributeArr=$_POST['attribute'];
                    $priceArr=$_POST['price'];
                    foreach($attributeArr as $key=>$val){
                        $attribute=$val;
                        $price=$priceArr[$key];
                        mysqli_query($con,"INSERT into dish_details (dish_id,attribute,price,status,added_on) values('$did','$attribute','$price',1,'$added_on')");
                    }
                    header('location:dish.php');
                }
            }else{
                $image_condition='';
                if($_FILES['image']['name']!=''){
                     if($type!='image/jpeg' && $type!='image/png'){
                        $image_error="Invalid Image Format";
                    }else{
                        $image=$_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'],SERVER_DISH_IMAGE.$_FILES['image']['name']);
                        $image_condition=" , image='$image'";
                     }
                    
                }
                if($image_error==''){
                    $sql="UPDATE dish set category_id='$category_id', dish='$dish', dish_details='$dish_details'$image_condition where id='$id'";
                    mysqli_query($con,$sql);
                    $attributeArr=$_POST['attribute'];
                    $priceArr=$_POST['price'];
                    $dish_details_idArr=$_POST['dish_details_id'];
                      foreach($attributeArr as $key=>$val){
                        $attribute=$val;
                        $price=$priceArr[$key];
                          if(isset($dish_details_idArr[$key])){
                              $did=$dish_details_idArr[$key];
                              mysqli_query($con,"update dish_details set attribute='$attribute',price='$price' where id='$did'");
                
                          }else{
                              mysqli_query($con,"INSERT into dish_details (dish_id,attribute,price,status,added_on) values('$id','$attribute','$price',1,'$added_on')");
                
                          }
                            }
                    
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
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
                        
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Dish Details</label>
                            
                            
                        <?php if($id==0){?>
                        <div class="row">
                        <div class="col-5"><input type="text" class="form-control" placeholder="Attribute or Quantity" name="attribute[]" required>
                        </div>
                        <div class="col-5">
                        <input type="text" class="form-control" placeholder="price" name="price[]" required>
                        </div>
                            </div></div>
                            <?php }else{
                            $dish_details_res=mysqli_query($con,"Select * from dish_details where dish_id='$id'");
                            $i=1;
                            while($dish_details_row=mysqli_fetch_assoc($dish_details_res)){  
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-5">
                                    <input type="hidden" name="dish_details_id[]" value="<?php echo $dish_details_row['id'] ?>">
                                    <input type="text" class="form-control" placeholder="Attribute or Quantity" name="attribute[]" value="<?php echo $dish_details_row['attribute']?>" required>
                                </div>
                          
                                <div class="col-5">
                                <input type="text" class="form-control" placeholder="price" name="price[]" value="<?php echo $dish_details_row['price'] ?>" required>
                                </div>
                                <?php if($i!=1){
                                ?>
                                <div class="form-group">
                                <div class="col-2"><button type="button" class="btn badge-danger" onclick="remove_more_new('<?php echo $dish_details_row['id'] ?>')" >Remove</button>
                                    </div>
                                </div>
                                 <?php } ?>
                                    
                               
                        </div>
                        <?php $i++; }}?>
                         <div id="dish_box1"></div>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="button" class="btn badge-danger" onclick="add_more()" >Add More</button>
                        </div>
                      </form>
                        
                </div>
                
            </div>    
        </div>  
            <input type="hidden" id="add_more" value="1"/>
        </div>        
    </body>
</html>
 <script>
      function remove_more(id){
                jQuery('#box'+id).remove();
            }
        function add_more(){
            var add_more=jQuery('#add_more').val();
            add_more++;
            jQuery('#add_more').val(add_more);
            var html='<div class="row form-group" id="box'+add_more+'"><div class="col-5"><input type="text" class="form-control" placeholder="Attribute or Quantity" name="attribute[]" required></div><div class="col-5"><input type="text" class="form-control" placeholder="price" name="price[]" required></div><div class="col-2"><button type="button" class="btn badge-danger" onclick=remove_more("'+add_more+'") >Remove</button></div></div>';
            jQuery('#dish_box1').append(html);
        }
        function remove_more_new(id){
            var result=confirm('Are You sure?');
            if(result==true){
                var cur_path=window.location.href;
                window.location.href=cur_path+"&dish_details_id="+id;
            }
        }  
        </script>
