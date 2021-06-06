<!DOCTYPE html>
<html>
  
<head>
    <title>Insert Page page</title>
</head>
  
<body>
    <center>
        <?php
        require_once "config.php";
        $dish_name =  $_REQUEST['dish_name'];
        $desc = $_REQUEST['des'];
        $price =  $_REQUEST['price'];

        $sql = "INSERT INTO dishes(dish_name,description,price)  VALUES ('$dish_name','$desc','$price')";
          
        if(mysqli_query($link, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 
  
            echo nl2br("\n$dish_name\n $desc\n "
                . "$price");
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($link);
        }
          
        // Close connection
        mysqli_close($link);
        ?>
    </center>
</body>
  
</html>