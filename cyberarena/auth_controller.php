<?php
session_start();
include "connect_to_database.php";
if (isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $min_passw_len = 8;
    $accepted_passw = false;
    $con = get_connection();

    if ($con){
        $email = mysqli_real_escape_string($con, $email);
        
        $plain_passw = mysqli_real_escape_string($con, $password);
        if (strlen($plain_passw)>=$min_passw_len){
            $accepted_passw = true;
        }
        $password = password_hash($plain_passw, PASSWORD_DEFAULT);
        
        if ($email && $password){
            if ($_POST["submit"] == "signup" && $accepted_passw){
                

                $test_query = "SELECT email FROM users WHERE email='$email'";
                $result = mysqli_query($con, $test_query);
                if (mysqli_num_rows($result) == 0){
                    $username = mysqli_real_escape_string($con, $_POST["username"]);
                    $user_join_date = date("Y-m-d H:i:s");
                    $query_user = "INSERT INTO `users` (`username`, `email`, `password`, `id_role`, `join_date`) 
                        VALUES ('$username', '$email', '$password', 3, '$user_join_date')";
                    mysqli_query($con,$query_user);
                    header("Location: login.php");
                    exit();
                }
                
            }
            
            else if($_POST["submit"] == "login" && $accepted_passw){
                $query = "SELECT * FROM users WHERE `email`='$email'";
                $result = mysqli_query($con,$query);
                $user = mysqli_fetch_assoc($result);
                if ($user){
                    if (password_verify($plain_passw, $user['password'])){
                        $_SESSION["user"] = $user;
                        header("Location: main.php");
                        exit();
                    }
                }
                
            }
        }
        
    }
    else{
        die("Something went wrong.");
    }

}

?>