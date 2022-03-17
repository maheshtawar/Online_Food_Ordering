<?php
session_start();
include('no_access.php');
include('admin/db.php');
 include('header.php');
$conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($con));

?>
 <style>
 html,body{
   height:100%;
}
.carousel,.item,.active{
   height:90%;
 }
.carousel-inner{
    height:100%;
}

.carousel-inner>.item>img, .carousel-inner>.item>a>img {
        display: block;
        height: auto;
        max-width: 100%;
        line-height: 1;
        margin:auto;
        width: 100%; // Add this
        }
</style>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/bg.jpg" alt="New York" width="1200" height="700">
        <div class="carousel-caption">
          <h3>WELCOME TO OUR PAGE</h3>
          <p>Enjoy Your Day</p>
        </div>      
      </div>

      <?php $res = mysqli_query($conn,"SELECT * FROM  offer order by rand() ");
       while ($row=mysqli_fetch_array($res)) { 
        if ($row['ostatus']== 1) {
          ?>
      <div class="item">
        <img src="img/<?php echo $row['image_path'] ?>" alt="Chicago"  width="1200" height="700">
        <div class="carousel-caption">
          <h3><?php echo $row['oname'] ?></h3>
          <p><?php echo $row['oprice']."\n only" ?></p>
        </div>      
      </div>
      <?php } } ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  <br><br>

  <!--Main-->
<div class="container">
  <div class="row row-eq-height">
    <div class="col-lg-3 col-md-3 col-12">
        <div class="offer" style="background-clip: padding-box;padding: 15px;background: white;border-radius: 25px;">
            OFFERS <br><br>
            <?php $res = mysqli_query($conn,"SELECT * FROM  offer order by rand() ");
            while ($row=mysqli_fetch_array($res)) { 
              if ($row['ostatus']== 1) {
              ?>
                <li><?php
                      echo $row ['oname']."<br>". $row ['oprice']."\n only";
                                            
            ?>
                </li>
                <br><br>
                <?php } } ?>
            
                
                
        </div>
    </div>
          <!--second-->
<div class="col-lg-6 col-md-6 col-12" style="background-clip: padding-box;padding: 15px;background: white;border-radius: 25px;">
        MENU <br><hr>
  <div class="media">
  <?php $res = mysqli_query($conn,"SELECT * FROM  product_list order by rand() ");



       while ($row=mysqli_fetch_array($res))  { 
        if ($row['status']==1) {
        ?>
       <form action="manage_cart.php" method="POST">
     <div class="media-left">
       
           <img src="img/<?php echo $row['img_path'] ?>" class="media-object" style="width:60px">
     </div>
     <div class="media-body">
                <h4 class="media-title"><?php echo $row['name'] ?></h4>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?php echo $row['id'] ?>">View</button><br><br>
       <div id="<?php echo $row['id'] ?>" class="collapse">
               Price :  <?php echo $row['price'] ?><br>
                <?php echo $row['description'] ?>
               <br> <br> QTY :  
               <!-- <form action="#" method="POST"> -->
               <input type="number" name="qty" min="1" max="10" class="text-center" value="1">
               <!-- <input type="submit" hidden>
               </form> -->
                 <br> <br><button type="submit" class="btn btn-info" name="add_to_cart">Add To Cart</button>
                 <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                 <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
                 
       </div>
     </div>
     </form>
     <br>
     <?php } } ?>
  </div>    
<!--div end-->
</div>

<!--third-->
    <div class="col-lg-3 col-md-3 col-12">
    
        <div class="cart" style="background-clip: padding-box; padding: 15px; background: white;border-radius: 25px;">
        <?php
          if (isset($_SESSION['cart'])) {
            $count=count($_SESSION['cart']);
          }
          echo $count." Items in <a href='cart.php' class='label label-success'>Cart</a>" ; 
          ?>
          <hr>
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
        
        <td>
        <form action='manage_cart.php' method='POST'>
        <button name='remove_btn1' class='glyphicon glyphicon-trash' style='font-size:0.9em;'></button>
        <input type='hidden' name='name' value='$value[name]'/>
        </form>
        </td> 

      </tr>";
  }
}?>
    
  </tbody>
</table>
          
          <hr>
          <div class="border bg-light rounded p-4">
        <h4>Total : </h4>
        <h5 class="text-right"><?php echo "$total"; ?></h5>
        <form action="checkout.php" method="post">
            <button class="btn btn-primary btn-block" id="checkout">Proceed to Checkout</button>
        </form>
    </div>
        </div>
        
    </div>
    <!--end third-->
    
  </div>
</div>
<br>

<?php include('footer.php') ?>
