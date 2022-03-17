<?php
include 'db.php';
session_start();
?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="../css/matrix-login.css"/>
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
<div id="loginbox">
    <form name="form1" class="form-vertical" action="" method="post">
        <div class="control-group normal_text"><h3>Admin Login Page</h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text"
                                                                                       placeholder="Username" name="username" required/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password"
                                                                                      placeholder="Password" name="password" required/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <center>
            <input type="submit" name="submit" value="Login" class="btn btn-success"/>
            </center>
        </div>
    </form>

<?php

if(isset($_POST["submit"]))
{
    $username = mysqli_real_escape_string($conn,$_POST["username"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $count = 0;

    $sql = mysqli_query($conn,"SELECT * FROM users WHERE username='".$username."' and password = '".$password."' and role = 'admin' and status = 'active'") or die(mysqli_error($conn));
    $count=mysqli_num_rows($sql);
    
    if ($count>0) {
        $_SESSION["admin"]=$username;   //use for unable to use another page without login
        ?>
        <script type = "text/javascript">
         window.location="dashboard.php";
         </script>
        <?php
    }
else{
    ?>
    <div class="alert alert-danger">
        INVALID USERNAME OR PASSWORD. 
        PLEASE ENTER VALID DATA.
    </div>
    <?php
}
}
?>
<div  onclick="window.location='../index.php';"> <span> User</span></div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/matrix.login.js"></script>
</body>

</html>
