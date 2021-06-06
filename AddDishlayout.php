<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>GFG- Store Data</title>
</head>
  
<body>
    <center>
        <h1>Storing Form data in Database</h1>
  
        <form action="AddDish.php" method="post">
              
            <p>
                <label for="dish_name">Dish Name:</label>
                <input type="text" name="dish_name" id="dishName">
            </p>
  
  
              
            <p>
                <label for="des">Description of Dish:</label>
                <input type="text" name="des" id="des">
            </p>
  
  
              
            <p>
                <label for="price">price:</label>
                <input type="text" name="price" id="price">
            </p>  
              
            <input type="submit" value="Submit">
        </form>
    </center>
</body>
  
</html>