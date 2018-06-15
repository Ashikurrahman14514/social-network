<?php
include("includes/connection.php");


if (isset($_POST['sign_up'])) {

$first_name=mysqli_real_escape_string($con,$_POST['u_first_name']);
$last_name=mysqli_real_escape_string($con,$_POST['u_last_name']);
$email=mysqli_real_escape_string($con,$_POST['u_email']);
$password=mysqli_real_escape_string($con,$_POST['u_password']);
$country=mysqli_real_escape_string($con,$_POST['u_country']);
$gender=mysqli_real_escape_string($con,$_POST['u_gender']);
$birthday=mysqli_real_escape_string($con,$_POST['u_birthday']);
$status="unverified";
$posts="no";
$ver_code= mt_rand();


    if(strlen($password)<8){
    echo"<script>alert('password should be minimum 8 characters!')</script>";
    exit();
    }

    $check_email ="SELECT * FROM `users`  WHERE `user_email`='$email'";
    $run_email =mysqli_query($con,$check_email);

    if (mysqli_num_rows($run_email) > 0) {
        echo "<seript><h3 style=color:#6d0d0d;>'Email already exist, please try another!</h3></script>";
        exit();
    }

    $insert = "insert into users(user_first_name,user_last_name,user_email,user_password,user_country,
    user_gender,user_birthday,user_image,user_reg_date,status,ver_code,posts)
    values('$first_name','$last_name','$email','$password','$country','$gender','$birthday',
    'default.jpg',NOW(),'$status','$ver_code','$posts')";

    $query =mysqli_query($con,$insert);

    if($query){

        echo"<h3 style='width:300px; text-align:justify; color:#125b0f;'>Hi,
        $first_name $last_name congratulations, registration is almost complete,please check your email for final verification.</h3>";

    }
    else{
        echo"registration failed,try again!";
    }

}

?>