<?php
session_start();
include('no_access.php');
include('header.php');
include('db.php');
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
			// $conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($conn));
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
			 		<a href="view_orders.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary" >View Order</a>
                     
			 		</td>
			 </tr>
			<?php endwhile; ?>
		</tbody>
	</table>
		</div>
	</div>
	
</div>
