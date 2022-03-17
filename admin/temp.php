<?php
include('header.php');
?>
<div class="container-fluid" style="padding-top:8%;">

    <div class="card">
		<div class="card-body">
			<table class="table table-bordered">
		<thead>
			 <tr>

			<th>#</th>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//$i = 1;
			$conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($conn));
			$qry = $conn->query("SELECT * FROM orders ");

			while($row=$qry->fetch_assoc()):
			 ?>
			 <tr>
			 		<td><?php echo $row['id'] //$i++ ?></td>
			 		<td><?php echo $row['name'] ?></td>
			 		<td><?php echo $row['address'] ?></td>
			 		<td><?php echo $row['email'] ?></td>
			 		<td><?php echo $row['mobile'] ?></td>
			 		<?php if($row['status'] == 1): ?>
			 			<td class="text-center"><span class="label label-success">Confirmed</span></td>
			 		<?php else: ?>
			 			<td class="text-center"><span class="label label-warning">For Verification</span></td>
			 		<?php endif; ?>
			 		<td>
                     
                     <!-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row['id'] ?>">Open Modal</button>  -->
			 		<a href="view_orders.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary">View Order</a>
                     
			 		</td>
			 </tr>
			<?php endwhile; ?>
		</tbody>
	</table>
		</div>
	</div>
	
</div>


<!-- --------------------------------------------------------
-----------------------------
------------- -->


<div class="container-fluid">
	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order</h4>
      </div>
      <div class="modal-body">
        
      <table class="table table-bordered">
		<thead>
			<tr>
				<th>Qty</th>
				<th>Order</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$total = 0;
            $conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($conn));
            $res = mysqli_query($conn,"SELECT * FROM order_list ol,orders o,product_list p WHERE ol.order_id=o.id AND ol.product_id=p.id and order_id=".$_GET['id']);
            
			  while ($row=mysqli_fetch_array($res))  { 
				$total += $row['qty'] * $row['price'];
			?>
			<tr>
				<td><?php echo $row['qty'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo number_format($row['qty'] * $row['price'],2) ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2" class="text-right">TOTAL</th>
				<th ><?php echo number_format($total,2) ?></th>
			</tr>

		</tfoot>
	</table>
	<div class="text-center">
		<button class="btn btn-primary" name="confirm" type="button" onclick="confirm_order()">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

	</div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<?php
if (isset($_POST["confirm"])) {
    
}
?>	

<script>
	function confirm_order(){
		start_load()
		
			url:'ajax.php?action=confirm_order',
			method:'POST',
			data:{id:'<?php echo o.id ?>'},
			success:function(resp){
				if(resp == 1){
					alert_toast("Order confirmed.")
                        setTimeout(function(){
                            location.reload()
                        },1500)
				}
			}
	
	}
</script>

<!-- ***************************************************************************
 -->
 <?php include('header.php');
include('db.php');
$id = $_GET["id"];
$oname="";
$oprice="";
$image_path="";
$ostatus="";
$res = mysqli_query($conn,"SELECT * FROM `offer` where id=$id");
while ($row = mysqli_fetch_array($res)) {
    $oname = $row["oname"];
    $oprice = $row["oprice"];
    $image_path = $row["image_path"];
    $ostatus = $row["ostatus"];
    
}
 ?>
<div class="container" style="padding-top:8%;">
<div class="row row-eq-height">
    <div class="col-lg-5 col-md-5 col-12">
        <div class="card">
        <h5 class="card-header">Offer Form</h5>
        <hr>
        <div class="card-body">
        <form name="offer_form" method="post">
            <label for="name1">Offer Name</label>
            <br><input type="text" name="name1" id="name1" value="<?php echo $oname; ?>">
            <br><label for="price">Price</label>
            <br><input type="text" name="price1" id="price1" value="<?php echo $oprice; ?>">
            <br><label for="file1">Image</label>
            <input type="file" name="file1" id="file1"><br><img src="../img/<?php echo $image_path ;?>" width="50px;" height="50px;" >
            <br><label for="available">Available</label>
            <input type="text" name="available" id="available" value="<?php echo $ostatus; ?>">
            <br><br><input type="submit" name="edit_offer_submit" class="btn btn-primary" Value="Update">
            
        </form>
        </div>
            <!-- end card body -->
        </div> 
        <!-- end card class -->

    </div>
          <!--second-->
<div class="col-lg-7 col-md-7 col-12" style="background-clip: padding-box;padding: 15px;background: white;border-radius: 25px;">
        Offers <br><hr>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Img</th>
      <th scope="col">Menu</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
       $i = 1;
        $res = mysqli_query($conn,"SELECT * FROM  offer order by rand() ");
       while ($row=mysqli_fetch_array($res))  { 
         ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="../img/<?php echo $row['image_path'] ;?>" width="50px;" height="50px;"></td>
      <td>
                <p>Name : <b><?php echo $row['oname'] ?></b></p>
				<p>Price : <b><?php echo "$".number_format($row['oprice'],2) ?></b></p>
       </td>
      <td>
      <a href="edit_offer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">  Edit</a>
      <br><br><a href="delete_offer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
     
      </td>
    </tr>
    <?php }; ?>
  </tbody>
</table>

<!--div end-->
</div>

    
</div>
</div>

<?php

if (isset($_POST["edit_offer_submit"])) {
    mysqli_query($conn,"UPDATE `offer` SET `oname` = '$_POST[oname]', `oprice` = '$_POST[oprice]', `image_path` = '$_POST[image_path]' WHERE `offer`.`id` = $id");
    ?>
    <script type="text/javascript">
          
    alert('Offers Updated');
    location.replace("offers.php")
        </script>
        <?php
}


?>
