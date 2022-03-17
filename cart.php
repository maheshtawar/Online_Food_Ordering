<?php
session_start();
 include('no_access.php');
 include('admin/db.php');
 include('header.php');
// $conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($con));

?>

<br><br><br><br>
	<div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
                <h1>My Cart</h1>
            </div>
<div class="col-lg-9">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Sr. No.</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Total</th>
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
        <td> $sr </td> 
        <td>$value[name]</td> 
        <td>$value[price]</td> 
        <td>$value[qty]</td> 
        <!-- <td><input type='number' value='$value[qty]' min='1' max='10' class='text-center'></td> -->
        <td>$per_total</td>
        <td>
        <form action='manage_cart.php' method='POST'>
        <button name='remove_btn' class='btn btn-sm btn-outline-danger glyphicon glyphicon-trash'></button>
        <input type='hidden' name='name' value='$value[name]'/>
        </form>
        </td> 
      </tr>";
  }
}?>
    
  </tbody>
</table>
</div>
<div class="col-lg-3">
    <div class="border bg-light rounded p-4">
        <h4>Total Amount : </h4>
        <h5 class="text-right"><?php echo "$total"; ?></h5>
        <form action="checkout.php" method="post">
            <button class="btn btn-primary btn-block">Proceed to Checkout</button>
        </form>
    </div>
</div>
        </div>
    </div>