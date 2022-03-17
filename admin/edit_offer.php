<?php
session_start();
include('no_access.php');
 include('header.php'); 
include('db.php');
$id = $_GET["id"];
$oname="";
$oprice="";
$image_path="";
$ostatus="";
$res = mysqli_query($conn,"SELECT * from offer where id=$id");
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
        <h5 class="card-header"> <b>Offer Form</b></h5>
        <hr>
        <div class="card-body">
        <form name="offer_form" method="post" enctype="multipart/form-data">
            <label for="oname">Offer Name</label>
            <br><input type="text" name="oname" id="oname" value="<?php echo $oname; ?>">
            <br><label for="oprice">Price</label>
            <br><input type="text" name="oprice" id="oprice" value="<?php echo $oprice; ?>">
            <br><label for="ostatus">Available</label>
            <br><input type="text" name="ostatus" id="ostatus" value="<?php echo $ostatus; ?>">
            <br><label for="image">Image</label>
            <br><input type="file" name="image" id="image" ><br><img src="../img/<?php echo $image_path ;?>" width="50px;" height="50px;" >
            <input type="text" name="image_path" value="<?php echo $image_path; ?>">
            <br>
            
            <br><input type="submit" class="btn btn-primary" name="offer_submit">
           
        </form>
        </div>
            <!-- end card body -->
        </div> 
        <!-- end card class -->

    </div>
          <!--second-->
<div class="col-lg-7 col-md-7 col-12" style="background-clip: padding-box;padding: 15px;background: white;border-radius: 25px;">
       <b> Offers </b> <br><hr>
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
       include('db.php');
       $res = mysqli_query($conn,"SELECT * FROM  offer order by rand() ");
       while ($row=mysqli_fetch_array($res))  { 
         ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="../img/<?php echo $row['image_path']; ?>" alt="" width="50px;" height="50px;"></td>
      <td>
                <p>Name : <b><?php echo $row['oname'] ?></b></p>
				<p>Price : <b><?php echo "Rs.".number_format($row['oprice'],2) ?></b></p>
       </td>
      <td>
      <a href="edit_offer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
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

if (isset($_POST["offer_submit"])) {
  if ($img_path=="") {
    $img = $_FILES['image']['name'];
    $query = mysqli_query($conn,"UPDATE offer set oname='$_POST[oname]',oprice='$_POST[oprice]',image_path='$img',ostatus='$_POST[ostatus]' where id=$id");
        if ($query) {
          move_uploaded_file($_FILES['image']['tmp_name'],"../img/$img");
        } //end if query;
  } //end null img_path;
  else {
    mysqli_query($conn,"UPDATE offer set oname='$_POST[oname]',oprice='$_POST[oprice]',image_path='$_POST[image_path]',ostatus='$_POST[ostatus]' where id=$id");

  }
  ?>
  <script type="text/javascript">
          
          alert('Offers Updated');
          location.replace("offers.php")
  </script>            
      <?php   
}


?>
