<?php
include('top.php');
if(isset($_GET['type'])&& $_GET['type']!=='' && isset($_GET['staff_id']) && $_GET['staff_id'] >0){
    $type = get_safe_value($_GET['type']);
    $staff_id=get_safe_value($_GET['staff_id']);
    if($type=='active' || $type=='deactive'){
        $status=1;
        if($type=='deactive'){
            $status=0;
        }
        mysqli_query($con,"update staff_user set status='$status' where staff_id='$staff_id'");
        redirect('staff_user.php');
    }
}
$sql = "SELECT * FROM staff_user order by staff_id desc";
$res= mysqli_query($con,$sql);
?>


<html>
<head>
<link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    
</head>

    <body>
    <div class="card-body">
       <center> <h1>User Master</h1> 
            </center>
                <nav class="navbar navbar-light bg-light">
                <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                </nav>
            <div class ="row">
                <div class="col-12">
                    <div class="table-responsive">
                       <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                            
                            <tr>
                                <th width="12%">Serial Number</th>
                                <th width="50%">Name</th>
                                <th width="10%">User Name</th>
                                <th width="10%">Mobile</th>
                                <th>Action</th>
                                
                            </tr>
                            <?php if(mysqli_num_rows($res)>0) { 
                            $i=1;
                            while ($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['username']?></td>
                                <td><?php echo $row['Mobile']?></td>
                                <td>

                                    <?php
                                    if($row['status']==1){
                                    ?>
                                    <a href="?staff_id=<?php echo $row['staff_id']?>&type=deactive"><label class=" badge badge-info">Active</label>"</a>
                                    <?php
                                    }else
                                    {
                                    ?>
                                    <a href="?staff_id=<?php echo $row['staff_id']?>&type=active"><label class=" badge badge-danger">Deactive</label>"</a>
                                     <?php   
                                    }
                                    
                                    ?>
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

