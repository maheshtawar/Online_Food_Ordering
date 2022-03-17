<?php
//to access only for login page

if(!isset($_SESSION["admin"]))
{
  ?>
  <script type="text/javascript">
      window.location="index.php";
  </script>
  <?php
}
?>