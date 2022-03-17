<?php
session_start();
include('no_access.php');
 include('header.php'); ?>

<div class="container-fluid" style="padding-top:5%;">
        
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
		<form method="post">
		<input type="submit" value="Confirm" name="confirm" class="btn btn-primary">
		</form>
		
        <br>
		<button onclick="myFunction()" class="btn btn-secondary">Close</button>

	</div>
</div>

     



<?php
if (isset($_POST["confirm"])) {
	mysqli_query($conn,"UPDATE `orders` SET `status` = '1' WHERE `orders`.`id` =".$_GET['id']);
	?>
	<script>
		alert('Order Confirm');
		location.replace("orders.php")
	</script>
	<?php
}
?>	

<script>
function myFunction() {
  location.replace("orders.php")
}
</script>