<?php
require_once("connect_to_database.php");
if (isset($_SESSION["user"]) && isset($_POST["submit"])) {
    if ($_POST["submit"] == "deleteaccount") {

        $conn = get_connection();
        $email = $_POST["emailmanage"];
        $sql = "DELETE FROM users WHERE email = '$email'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        session_unset();
        session_destroy();
        header("Location: main.php");
        exit();
        
    }
}
?>