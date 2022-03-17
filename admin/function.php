<?php
session_start();
include('no_access.php');
include('db.php');
$order_count = 0;
$processing_count = 0;
$confirm_count = 0;
// for total orders
$qry = $conn->query("SELECT * FROM orders ");
while($row=$qry->fetch_assoc()){
    $order_count++;
}

// for Processing Orders
$qry = $conn->query("SELECT * FROM orders where status='0'");
while($row=$qry->fetch_assoc()){
    $processing_count++;
}


// for Confirm Orders
$qry = $conn->query("SELECT * FROM orders where status='1'");
while($row=$qry->fetch_assoc()){
    $confirm_count++;
}
?>