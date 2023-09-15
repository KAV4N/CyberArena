<?php

if (isset($_SESSION["user"]) && isset($_POST["submit"])){
    if ($_POST["submit"] == "update"){
        $conn = get_connection();
        $user = $_SESSION["user"];  

        $min_passw_len = 8;
        $accepted_passw = false;

        $new_username = mysqli_real_escape_string($conn, $_POST["username"]);
        $new_password = mysqli_real_escape_string($conn, $_POST["password"]);
        $new_profile_pic = mysqli_real_escape_string($conn, $_POST["profilepic"]);
        $new_bio = mysqli_real_escape_string($conn, $_POST["bio"]);
        $id = $user["id_user"];
        if (strlen($new_password)>=$min_passw_len){
            $accepted_passw = true;
        }
        if ($new_password && $new_username && $accepted_passw){

            if($new_password != $user["password"]){
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password = '$new_password' WHERE id_user='$id'";
                $result = mysqli_query($conn, $query);
                if ($result){
                    $user["password"] = $new_password;
                }
            }
            $query = "UPDATE users
                      SET username = '$new_username',  bio = '$new_bio', profile_picture = '$new_profile_pic'
                      WHERE id_user = '$id'";

            $result = mysqli_query($conn, $query);
            
            if ($result){
                $user["username"] = $new_username;
                $user["bio"] = $new_bio;
                $user["profile_picture"] = $new_profile_pic;
                $_SESSION["user"] = $user;
                header("Location: user_info.php");
                exit();
            }
        }
        mysqli_close($conn);
    }
        
}
    
?>