<?php
include('top.php');
$msg="";
$image="";
$heading="";
$sub_heading="";
$link="";
$link_text="";
$order_number="";
$id="";
$image_status='required';
$image_error="";
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $id=get_safe_value($_GET['id']);
    $row =mysqli_fetch_assoc(mysqli_query($con,"SELECT * from banner where id='$id'"));
    $image=$row['image'];
    $heaading=$row['heading'];
    $sub_heaading=$row['sub_heading'];
    $link=$row['link'];
    $link_text=$row['link_text'];
    $order_number=$row['order_number'];
    $image_status='';
}
if(isset($_POST['submit'])){
    $heading=get_safe_value($_POST['heading']);
    $sub_heading=get_safe_value($_POST['sub_heading']);
    $link=get_safe_value($_POST['link']);
    $link_text=get_safe_value($_POST['link_text']);
    $order_number=get_safe_value($_POST['order_number']);
    $added_on=date('Y-m-d h:i:s');
   

        if($id=='')
        {
             $type=$_FILES['image']['type'];
             
                if($type!='image/jpeg' && $type!='image/png'){
                    $image_error="Invalid Image Format";
                }else{
                    $image=$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],SERVER_BANNER_IMAGE.$_FILES['image']['name']);
        mysqli_query($con,"INSERT INTO banner(heading,sub_heading,link,link_text,order_number,status,added_on,image) values ('$heading','$sub_heading','$link','$link_text','$order_number',1,'$added_on','$image')");
              header('location:banner.php');
                }
        }else
        {
             $type=$_FILES['image']['type'];
            if($_FILES['image']['name']==''){
        mysqli_query($con,"Update banner set heading='$heading',sub_heading='$sub_heading', link='$link',link_text='$link_text',order_number='$order_number' where id='$id'");
        }else{
                if($type!='image/jpeg' && $type!='image/png'){
                    $image_error="Invalid Image Format";
                }else{
                    mysqli_query($con,"Update banner set heading='$heading',sub_heading='$sub_heading', link='$link',link_text='$link_text',order_number='$order_number',image='$image' where id='$id'");
                    header('location:banner.php');
                    
                }
            }

        }
        }

?>
<html>
<head>
<link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">    

    
</head>

    <body>
        <div class="card-body"><center>
            <h3 class="carg-title m110">Banner Manager</h3></center>
        <div class="col-12 grid-margin stretch-card">
            <div class="container">
                <div class ="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Heading</label>
                        <input type="text" class="form-control" name="heading" placeholder="heading" required value="<?php echo $heading ?>">
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Sub-Heading</label>
                        <input type="text" class="form-control" name="sub_heading" placeholder="sub_heading" required value="<?php echo $sub_heading ?>">
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Link</label>
                        <input type="text" class="form-control" name="link" placeholder="Link" required value="<?php echo $link ?>">
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Link Text</label>
                        <input type="text" class="form-control" name="link_text" placeholder="Link Text" required value="<?php echo $link_text ?>">
                        </div>
                        <p style="color:red;"><?php echo $msg ?></p>
                         <div class="form-group">
                        <label for="exampleFormControlInput1">Order Number:</label>
                        <input type="text" class="form-control" name="order_number" placeholder="order number" value="<?php echo $order_number ?>">
                             
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Banner Image:</label>
                        <input type="file"  class="form-control" name="image" placeholder="Upload Banner Image" <?php echo $image_status ?> >   
                        </div>
                        <p style="color:red;"><?php echo $image_error ?></p>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      </form>
                </div>
            </div>    
        </div>    
        </div>
        
    </body>
</html>
