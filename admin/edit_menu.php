
<?php
session_start();
include('no_access.php');
 include('header.php');
include('db.php');
$id = $_GET["id"];

$name="";
$description="";
$price="";
$img_path="";
 $status="";
$res = mysqli_query($conn,"SELECT * FROM `product_list` where id=$id");
while ($row = mysqli_fetch_array($res)) {
    
    $name = $row["name"];
    $description = $row["description"];
    $price = $row["price"];
    $img_path = $row["img_path"];
     $status = $row["status"];
}
 ?>
<div class="container" style="padding-top:8%;">
<div class="row row-eq-height">
    <div class="col-lg-5 col-md-5 col-12">
        <div class="card">
        <h5 class="card-header">Menu Form</h5>
        <hr>
        <div class="card-body">
        <form name="menu_form" method="post" enctype="multipart/form-data">
            <label for="name">Menu Name</label>
            <br><input type="text" name="name" id="name" value="<?php echo $name; ?>">
            <br><label for="description">Menu Description</label>
            <br><textarea name="description" id="description" cols="30" rows="10"><?php echo $description; ?></textarea>
            <br><label for="status">Available</label>
            <input type="text" name="status" id="status" value="<?php echo $status; ?>">
            <br><label for="price">Price</label>
            <br><input type="text" name="price" id="price" value="<?php echo $price; ?>">
            <br><label for="image">Image</label>
            <input type="file" name="image" id="image"><br><img src="../img/<?php echo $img_path ;?>" width="50px;" height="50px;" >
            <input type="text" name="img_path" value="<?php echo $img_path; ?>">
            <br><br><input type="submit" name="edit_menu_submit" class="btn btn-primary" Value="Update">
            
        </form>
        </div>
            <!-- end card body -->
        </div> 
        <!-- end card class -->

    </div>
          <!--second-->
<div class="col-lg-7 col-md-7 col-12" style="background-clip: padding-box;padding: 15px;background: white;border-radius: 25px;">
        MENU <br><hr>
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
        $res = mysqli_query($conn,"SELECT * FROM  product_list order by rand() ");
       while ($row=mysqli_fetch_array($res))  { 
         ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="../img/<?php echo $row['img_path'] ;?>" width="50px;" height="50px;"></td>
      <td>
                <p>Name : <b><?php echo $row['name'] ?></b></p>
				<p>Description : <b class="truncate"><?php echo $row['description'] ?></b></p>
				<p>Price : <b><?php echo "Rs.".number_format($row['price'],2) ?></b></p>
       </td>
      <td>
      <a href="edit_menu.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">  Edit</a>
      <br><br><a href="delete_menu.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
     
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

if (isset($_POST["edit_menu_submit"])) {
  if ($img_path=="") {
    $img = $_FILES['image']['name'];
    $query = mysqli_query($conn,"UPDATE product_list set name='$_POST[name]',description='$_POST[description]',price='$_POST[price]',img_path='$img',status='$_POST[status]' where id=$id");
        if ($query) {
          move_uploaded_file($_FILES['image']['tmp_name'],"../img/$img");
        } //end if query;
  } //end null img_path;
  else {
    mysqli_query($conn,"UPDATE product_list set name='$_POST[name]',description='$_POST[description]',price='$_POST[price]',img_path='$_POST[img_path]',status='$_POST[status]' where id=$id");

  }
  ?>
  <script type="text/javascript">
        
  alert('Menu Updated');
  location.replace("menu.php")
      </script>
      <?php   
}


?>
