<?php
session_start();
include('no_access.php');
include "db.php";
$id = $_GET["id"];
mysqli_query($conn,"DELETE from offer where id=$id");
?>
<script type="text/javascript">
          
          alert('Offer Deleted');
          location.replace("Offers.php")
              </script>