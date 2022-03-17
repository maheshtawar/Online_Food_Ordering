<?php
include('header.php');
session_start();
include('no_access.php');
include('function.php');

?>
<div class="container" style="padding-top:8%;">
	<div class="row">
		<div class="col-md-4">
			<div class="dbox dbox--color-1">
				<div class="dbox__icon">
					<i class="glyphicon glyphicon-envelope"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?php echo $order_count; ?></span>
					<span class="dbox__title">Total Orders</span>
				</div>
				
				
			</div>
		</div>
		<div class="col-md-4">
			<div class="dbox dbox--color-2">
				<div class="dbox__icon">
					<i class="glyphicon glyphicon-refresh"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?php echo $processing_count; ?></span>
					<span class="dbox__title">Processing</span>
				</div>
				
				
			</div>
		</div>
		<div class="col-md-4">
			<div class="dbox dbox--color-3">
				<div class="dbox__icon">
					<i class=" glyphicon glyphicon-ok"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?php echo $confirm_count; ?></span>
					<span class="dbox__title">Confirmed</span>
				</div>
				
				
			</div>
		</div>
	</div>
</div>
