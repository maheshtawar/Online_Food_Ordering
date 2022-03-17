<html>
    <head>
        <title> Login page</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="main">
        
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button class="toggle-btn" onclick="login()">Login</button>
                    <button class="toggle-btn" ><h6>Admin Login</h6></button>
                    
                </div>

                <form class="input-group" id="login" method="POST" name="form1">
                    <input type="text" class="input-field" name="username" id="username" placeholder="USERNAME" required>
                    <br><br><br><input type="password" class="input-field" name="password" id="password" placeholder="PASSWORD" required>
                    <br><br><br>
                    <input type="submit" value="Login" class="submit-btn" name="submit1">
                    <br><br><center><h6 id="alert" style="color:red;"></h6></center>
                </form>
                <?php
                session_start();
include('db.php');
if(isset($_POST["submit1"]))
  {
      $username = mysqli_real_escape_string($conn,$_POST["username"]);
      $password = mysqli_real_escape_string($conn,$_POST["password"]);
      $count = 0;

      $sql = mysqli_query($conn,"SELECT * FROM users WHERE username='".$username."' and password = '".$password."' and role = 'admin' and status = 'Active'") or die(mysqli_error($conn));
      $count=mysqli_num_rows($sql);
      
      if ($count>0) {
          $_SESSION["admin"]=$username;
?>
          <script type = "text/javascript">
           window.location="dashboard.php";
           </script>
      <?php
      }
  else{
      ?>
      <script>
         document.getElementById("alert").innerHTML ="INVALID USERNAME OR PASSWORD.<br>PLEASE ENTER VALID DATA"; 
        //   alert('INVALID USERNAME OR PASSWORD.PLEASE ENTER VALID DATA');
      </script>
     
      <?php
  }
}
  ?>          
            </div>
           
        </div>
      
    </body>
</html>