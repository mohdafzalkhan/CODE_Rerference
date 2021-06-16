<?php
include('top.php');
if(isset($_GET['type'])&& $_GET['type']!=='' && isset($_GET['id']) && $_GET['id'] >0){
    $type = $_GET['type'];
    $id=$_GET['id'];
    if($type=='delete'){
        mysqli_query($con,"DELETE from food_category where id ='$id'");
        header('location:category.php');
    }
    if($type=='active' || $type=='deactive'){
        $status=1;
        if($type=='deactive'){
            $status=0;
        }
        mysqli_query($con,"update food_category set status='$status' where id='$id'");
        header('location:category.php');
    }
}
$sql = "SELECT * FROM food_category order by order_number";
$res= mysqli_query($con,$sql);
?>
<html>
<head>
<link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">    

    
</head>

    <body>
    <div class="card-body">
        <h1>Food Category</h1>
            <div class ="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            
                            <tr>
                                <th width="12%">Serial Number</th>
                                <th width="50%">Category</th>
                                <th width="10%">Order Number</th>
                                <th>Action</th>
                                
                            </tr>
                            <?php if(mysqli_num_rows($res)>0) { 
                            $i=1;
                            while ($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['category']?></td>
                                <td><?php echo $row['order_number']?></td>
                                <td>
                                <a href=""><label class="badge badge-primary">Edit</label></a>
                                    &nbsp;
                                    <?php
                                    if($row['status']==1){
                                    ?>
                                    <a href="?id=<?php echo $row['id']?>&type=deactive"><label class=" badge badge-info">Active</label>"</a>
                                    <?php
                                    }else
                                    {
                                    ?>
                                    <a href="?id=<?php echo $row['id']?>&type=active"><label class=" badge badge-danger">Deactive</label>"</a>
                                     <?php   
                                    }
                                    
                                    ?>
                                    <a href=""><label class="badge badge-warning">Pending</label></a>
                                    &nbsp;
                                    <a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger">Delete</label></a> 
                                </td>                                
                                <td></td>
                            </tr>
                            <?php
                            $i++;
                            } } else { ?>
                            <tr>
                            <td rowspan="5"><center>No data found</center></td>
                            </tr>
                            <?php } ?>
                        </table>    
                    </div>
                </div>
            </div>
        
    </div>
    </body>
</html>
