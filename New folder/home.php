<!DOCTYPE html>
<?php

include("includes/connection.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/kstyle.css" media="all">
    <title>home</title>
</head>
<body>
    <div class="body1">
        <div class="body2">
            <div class="header">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="members.php">Members</a></li>
                    <strong>Topics:</strong>
                    <?php
                    $get_topics="SELECT * FROM `topics`";
                    $run_topics= mysqli_query($con,$get_topics);

                    while($row=mysqli_fetch_array($run_topics)){
                        $topic_id=$row["topic_id"];
                        $topic_name=$row["topic_name"];
                        echo"<li><a href='topic.php?topic=$topic_id'>$topic_name</a></li>";
                    }
                    ?>
                </ul>
                <form action="results.php" method="get">
                    <input type="text" name="user_query" placeholder="Search a topic" required="required" style="padding-left: 7px;">
                    <input type="submit" name="search" value="Search" style="width:60px; background:gold;">
                </form>
            </div>
        </div>
        <div class ="body3">
            <div class="body4">
                    <?php

                    $get_user= "SELECT * FROM `users` WHERE `user_email` ";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $user_first_name = $row['user_first_name'];
                    $user_last_name = $row['user_last_name'];
                    $user_country = $row['user_country'];
                    $user_image = $row['user_image'];
                    $register_date = $row['user_reg_date'];
                    $last_login = $row['user_last_login'];

                    $user_posts = "SELECT * FROM `posts`WHERE `user_id`='$user_id'";
                    $run_posts = mysqli_query($con,$user_posts);
                    $posts = mysqli_num_rows($run_posts);


                    //massages
                    $sel_msg = "SELECT * FROM `messages` WHERE `receiver`='$user_id' AND status ='unread' ORDER BY 1 DESC";
                    $run_msg = mysqli_query($con,$sel_msg);

                    $count_msg = mysqli_num_rows($run_msg);


                    echo "
                        <center>
                        <img src ='users/$user_image' width ='200' height ='200'/>
                        </center>
                        <div id ='user_mention'>
                        <p><strong>Name:<strong> $user_first_name $user_last_name</p>
                        <p><strong>Country:<strong> $user_country</p>
                        <p><strong>Last login:<strong> $last_login</p>
                        <p><strong>Member Since:<strong> $register_date</p>
                        
                        <p><a href ='my_messages.php?inbox&u_id = $user_id' >Messages ($count_msg)</a></p>
                        <p><a href ='my_posts.php?u_id = $user_id' >My Posts ($posts)</a></p>
                        <p><a href ='edit_profile.php?u_id = $user_id' >Edit My Account</a></p>
                        <p><a href ='logout.php'>Logout</a></p>
                        </div>
                        ";
                    ?>
            </div>
        </div>
    </div>
</body>
</html>