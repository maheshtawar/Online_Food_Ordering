<?php
session_start();
include('no_access.php');
// include('admin/db.php');
 include('header.php') ?>
<br><br>
<div class="card text-center">
  <div class="card-header">
    <h1>Contact Us</h1>
  </div><br><br>
  <div class="card-body">
    <form action="#" method="post">
   
       
    <label for="name">Full Name : </label>
    <input type="text" name="name" id="name"><br><br>
    <label for="mobile">Mobile No. : </label>
    <input type="tel" name="mobile" id="mobile"><br><br>
    
    <label for="email">Email : </label>
    <input type="email" name="email" id="email"><br><br>
    <label for="description">Description : </label><br>
    <textarea name="description" cols="30" rows="5"></textarea><br><br>
        <label for="send"></label>
        <input type="button" value="SEND">
    </form>
  </div><br>
  <div class="card-footer text-muted">
    Thanks to Connect with us
  </div>
</div>
<br>

<?php include('footer.php') ?>