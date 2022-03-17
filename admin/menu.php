<?php
session_start();
include('no_access.php');
 include('header.php'); ?>
<div class="container" style="padding-top:8%;">
<div class="row row-eq-height">
    <div class="col-lg-5 col-md-5 col-12">
        <div class="card">
        <h5 class="card-header"> <b> Menu Form</b></h5>
        <hr>
        <div class="card-body">
        <form name="menu_form" method="post" enctype="multipart/form-data">
            <label for="name">Menu Name</label>
            <br><input type="text" name="name" id="name">
            <br><label for="description">Menu Description</label>
            <br><textarea name="description" id="description" cols="30" rows="10"></textarea>
            <br><label for="available">Available</label>
            <input type="checkbox" name="available" id="available" checked>
            <br><label for="price">Price</label>
            <br><input type="text" name="price" id="price" >
            <br><label for="image">Image</label>
            <input type="file" name="image" id="image" >
            <br><input type="submit" class="btn btn-primary" name="submit1">
            <input type="reset" value="Reset">
        </form>
        </div>
            <!-- end card body -->
        </div> 
        <!-- end card class -->

    </div>
          <!--second-->
<div class="col-lg-7 col-md-7 col-12" style="background-clip: padding-box;padding: 15px;background: white;border-radius: 25px;">
       <b> MENU </b> <br><hr>
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
       $res = mysqli_query($conn,"SELECT * FROM  product_list order by rand() ");
       while ($row=mysqli_fetch_array($res))  { 
         ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="../img/<?php echo $row['img_path']; ?>" alt="" width="50px;" height="50px;"></td>
      <td>
                <p>Name : <b><?php echo $row['name'] ?></b></p>
				<p>Description : <b class="truncate"><?php echo $row['description'] ?></b></p>
				<p>Price : <b><?php echo "Rs.".number_format($row['price'],2) ?></b></p>
       </td>
      <td>
      <a href="edit_menu.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
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
if(isset($_POST["submit1"]))
{
    $img = $_FILES['image']['name'];

        $query = mysqli_query($conn,"INSERT into product_list values(NULL,'$_POST[name]','$_POST[description]','$_POST[price]','$img','1')");
        if ($query) {
          move_uploaded_file($_FILES['image']['tmp_name'],"../img/$img");
        }
      ?>
       <script type="text/javascript">
           alert('Record Inserted Successfully !');
            setTimeout(function(){
                window.location.href = window.location.href;
            }, 500);
        </script>
     <?php
}
?>
