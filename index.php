<html>
    <head>
        <title> Login page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="main">
        
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button class="toggle-btn" onclick="login()">Login</button>
                    <button class="toggle-btn" onclick="register()">Register</button>
                    
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
include('admin/db.php');
if(isset($_POST["submit1"]))
  {
      $username = mysqli_real_escape_string($conn,$_POST["username"]);
      $password = mysqli_real_escape_string($conn,$_POST["password"]);
      $count = 0;

      $sql = mysqli_query($conn,"SELECT * FROM users WHERE username='".$username."' and password = '".$password."' and role = 'user' and status = 'active'") or die(mysqli_error($conn));
      $count=mysqli_num_rows($sql);
      
      if ($count>0) {
          $_SESSION["user"]=$username;
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
                <form class="input-group" id="register" method="POST" name="form2">
                    <input type="text" class="input-field" name="name" id="name" placeholder="NAME" required>
                    <input type="text" class="input-field" name="username" id="username" placeholder="USERNAME" required>
                    <input type="email" class="input-field" name="email" id="email" placeholder="EMAIL" required>
                    <input type="password" class="input-field" name="password" id="password" placeholder="PASSWORD" required>
                   <br> <div><input type="checkbox" class="check-box" required><span> I agree to the <a href='#'>terms & conditions</a></span></div>
                   <br> <input type="submit" value="Register" class="submit-btn" name=submit2>
              
                </form>

                <?php
if(isset($_POST["submit2"]))
{
    $res = mysqli_query($conn,"SELECT * from users where username='$_POST[username]'");
    $count = mysqli_num_rows($res);
    if($count>0)
    {
        ?>
        <script type="text/javascript">
            alert('This Username Alredy Exist ! Please Try Another.');
        </script>
        <?php
    }
    else{
        mysqli_query($conn,"INSERT into users values(NULL,'$_POST[name]','$_POST[email]','$_POST[username]','$_POST[password]','user','Active')");
        ?>
        <script type="text/javascript">
            alert('Record Inserted Successfully !');
            setTimeout(function(){
                window.location.href = window.location.href;
            }, 500);
        </script>
        <?php
    }
}
?>

            </div>
           <h6><a href="admin/index.php">Admin</a></h6>
        </div>
        <script>
            var x = document.getElementById("login");
            var y = document.getElementById("register");
            var z = document.getElementById("btn");

            function register() {
                x.style.left = "-400px";
                y.style.left = "50px";
                z.style.left = "110px";
            }
            function login() {
                x.style.left = "50px";
                y.style.left = "450px";
                z.style.left = "0px";
            }
            
        </script>



    </body>
</html>