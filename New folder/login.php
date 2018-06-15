<?php

include("includes/connection.php");

if(isset($_POST['login'])){

$email=mysqli_real_escape_string($con,$_POST['email']);
$password=mysqli_real_escape_string($con,$_POST['password']);

$select_user="SELECT * FROM `users`  WHERE `user_email`='$email'
AND `user_password`='$password'AND `status`='verified'";

$query= mysqli_query($con,$select_user);
if (mysqli_num_rows($query) > 0){

    $_SESSION['user_email']=$email;

    echo"<script>window.open('home.php','_self')</script>";
}
    else{
        echo"<script>alert('Email or password incorrect,try again!')</script>";
    }
}

?>