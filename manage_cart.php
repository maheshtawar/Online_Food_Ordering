<?php
session_start();
include('no_access.php');


if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['add_to_cart'])) {
        if (isset($_SESSION['cart'])) {
            $myitem = array_column($_SESSION['cart'],'name');
            if (in_array($_POST['name'],$myitem)) {
               echo "<script>
               alert('Already Added');
               window.location.href='dashboard.php';
               </script>";
            }
            else{
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array('name'=>$_POST['name'],'price'=>$_POST['price'],'qty'=>$_POST['qty']);
            echo "<script>
               alert('Added To Cart');
               window.location.href='dashboard.php';
               </script>";
            }
        }
        else {
            $_SESSION['cart'][0]=array('name'=>$_POST['name'],'price'=>$_POST['price'],'qty'=>$_POST['qty']);
            echo "<script>
               alert('Added To Cart');
               window.location.href='dashboard.php';
               </script>";
        }
    }

    //code for remove button
    if (isset($_POST['remove_btn'])) {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if ($value['name']==$_POST['name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']); //to rearrange array
                echo "<script>
               alert('Removed');
               window.location.href='cart.php';
               </script>";
            }
            
        }
    }

     //code for remove button in home page
     if (isset($_POST['remove_btn1'])) {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if ($value['name']==$_POST['name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']); //to rearrange array
                echo "<script>
               alert('Removed');
               window.location.href='dashboard.php';
               </script>";
            }
            
        }
    }
}
?>