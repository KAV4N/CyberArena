<?php
require_once("connect_to_database.php");
if (isset($_SESSION["user"]) && isset($_POST["submit"])) {
    if ($_POST["submit"] == "saveusers") {

        $conn = get_connection();
        $email = $_POST["emailmanage"];
        $role_name= $_POST["blogcat"];

        $query_get_role_id = "SELECT * FROM roles WHERE role_name = '$role_name'";
        

        $result_roles = mysqli_query($conn, $query_get_role_id);
        $role_id = mysqli_fetch_assoc($result_roles)["id_role"];

        $query = "UPDATE users
        SET id_role = '$role_id' WHERE email = '$email'";
        
        $result = mysqli_query($conn, $query);

        if (!$result){
            die('Query failed: ' . mysqli_error($conn));
        }
        mysqli_close($conn); 
    }
}
?>