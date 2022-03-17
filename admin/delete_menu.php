<?php
session_start();
include('no_access.php');
include "db.php";
$id = $_GET["id"];
mysqli_query($conn,"DELETE from product_list where id=$id");
?>
<script type="text/javascript">
          
          alert('Menu Deleted');
          location.replace("menu.php")
              </script>