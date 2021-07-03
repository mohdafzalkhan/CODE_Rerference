<?php
    session_start();
    include('staff_config.php');
    include('function.php');
    include('constant.php');
?>
<html>
<head>
<title>
<?php echo FRONT_SITE_NAME ?>
</title>

       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>  
  /* Make the image fully responsive */
  .carousel-inner img {
      padding-top: 0;
    width: 100%;
    height: 100%;
  }
.map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:50%;
width:100%;
position:absolute;
padding-top: 20px;
}
      
  </style>  
</head>
<body>

<div id="demo" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <!-- The slideshow -->
        
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Crousel/heartFood.jpg"  alt="Los Angeles" width="100%" height="500">
        <div class="carousel-caption d-none d-md-block"> 
            <a href="shop.php" class="btn btn-warning" >ORDER NOW</a>
    <h5>Hungryy!!?</h5>
    <p>Visit or Order to get delicious food..</p>
  </div>
    </div>
    <div class="carousel-item">
      <img src="Crousel/junk.jpg" alt="Chicago" width="100%" height="500">
        
            <div class="carousel-caption d-none d-md-block">
               <a href="shop.php" class="btn btn-warning" >ORDER NOW</a>
    <h5>Snack</h5>
    <p>Delicous and tasty food and snacks are here..</p>
  </div>
    </div>
    <div class="carousel-item">
      <img src="Crousel/veg.jpg" alt="New York" width="1100" height="500">
            <div class="carousel-caption d-none d-md-block">
                <a href="shop.php" class="btn btn-primary btn-lg" >ORDER NOW</a>
     <h5>Looking For Veg</h5>
    <p>Grab a pure Veg food here..</p>
  </div>
    </div>
  </div>
        </div>
 
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

    <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 100px">
  <iframe src="https://maps.google.com/maps?q=new%20delphi&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
    style="border:0" allowfullscreen></iframe>
    </div>
    

