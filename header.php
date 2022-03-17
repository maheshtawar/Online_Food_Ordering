<?php   ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Food Ordering System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<body>
<!--nav start-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button> 
        <a class="navbar-brand" href="dashboard.php">Food Garage</a>
      </div>
      <div class="collapse navbar-collapse navbar-right" id="myNavbar" style="padding-right:10%;">
        <ul class="nav navbar-nav">
          <li><a href="dashboard.php">Home<i class="glyphicon glyphicon-home"></i></a></li>

         <?php
         include('nav_cart.php');
          // $count=0;
          // if (isset($_SESSION['cart'])) {
          //   $count = count($_SESSION['cart']);
          // }
          ?>
          <li><a href="cart.php"> Cart<span  class=" glyphicon glyphicon-shopping-cart label label-success"><sup style="font-size:1em;"><?php echo $count ; ?></sup></span> </a></li>
          
          <li><a href="contact.php">Contact<i class="glyphicon glyphicon-book"></i></a></li>

          <li><a href="logout.php">Logout <i class="glyphicon glyphicon-log-out"></i></a></li> 
        </ul>
       <!-- 
         <form class="navbar-form navbar-right" action="/action_page.php">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        -->
      </div>
    </div>
  </nav>
  <!--nav end-->
