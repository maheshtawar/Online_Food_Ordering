<?php 
session_start();
 include('no_access.php');
 include('admin/db.php');
// $conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($con));
?>
<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Checkout Form</title>
    <link rel="stylesheet" href="css/style2.css">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

    <!-- Bootstrap core CSS -->
<link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    
    <h2>Checkout form</h2>
   
  </div>
  <form method="post" action="place_order.php">
  
</form>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
      
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">
        <?php $count=0;
      if (isset($_SESSION['cart'])) {
        $count=count($_SESSION['cart']);
      }
      echo $count." Items in <a href='cart.php'>Cart</a>" ; 
      ?>
        </span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
              
            <h6 class="my-0">
                
                
            <div class="cart">
    
    <div class="cart" style="background-clip: padding-box; padding: 15px; background: white;border-radius: 25px;">
    
      <table class="table">
<thead>
<tr>
  <th scope="col">Name</th>
  <th scope="col">Price</th>
  <th scope="col">Qty</th>
  <th scope="col">Sub-Total</th>
</tr>
</thead>
<tbody>
<?php
$total=0;
if(isset($_SESSION['cart'])){
foreach($_SESSION['cart'] as $key => $value)
{
  $sr=$key + 1;
  $per_total = $value['qty'] * $value['price'];
$total+=$per_total;
  echo "<tr>
    <td>$value[name]</td> 
    <td>$value[price]</td> 
    <td>$value[qty]</td> 
    <td>$per_total</td>
    
     

  </tr>";
}
}?>

</tbody>
</table>
      

    </div>
    
</div>
          
        
             
      
      
    
    </h6>
            
        
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (Rupees)</span>
          <strong><?php echo "$total"; ?></strong>
        </li>
      </ul>
    </div>

<?php
// to fetch login user details
$res = mysqli_query($conn,"SELECT * FROM users WHERE username='".$_SESSION['user']."'  and role = 'user' and status = 'active'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($res)) {
$id = $row['id'];
$name = $row['name'];
$mail = $row['mail'];
}
?>
  
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" method="POST" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="name">Full name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo "$name"; ?>" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
         
        </div>

        

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="<?php echo $mail; ?>">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        
        
        
        <div class="mb-3">
          <label for="mobile">Mobile No. : </label>
          <input type="text" class="form-control" name="mobile" id="mobile" placeholder="1234567890" required>
        </div>

        
        
        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="paypal">Cash On Delivery</label>
          </div>
        </div>
        <div class="row">
          
          
       
          </div>
         
          </div>
        </div>
        <hr class="mb-4">
        <!-- <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit1">Place Order</button> -->
        <input type="submit" name="submit1" class="btn btn-primary btn-lg btn-block" value="Place Order">
      </form>
    </div>
  </div>

  <?php include('footer.php'); ?>



  <?php
if(isset($_POST["submit1"]))
{
  mysqli_query($conn,"INSERT into orders values(NULL,'$_POST[name]','$_POST[address]','$_POST[mobile]','$_POST[email]','0','$id')");
  ?>
       <script type="text/javascript">
           alert('Record Inserted Successfully !');
            setTimeout(function(){
              location.replace("dashboard.php")
                // window.location.href = window.location.href;
            }, 500);
        </script>
     <?php
}
?>
