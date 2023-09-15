<?php
session_start();
require_once "connect_to_database.php";

if (isset($_SESSION["user"])&&isset($_POST["submit"])){
    $conn = get_connection();
    if(isset($_GET['id'])&&$conn) {
        $id = $_GET['id'];
        $query = "DELETE FROM blog_posts WHERE id_blog = " . $id;
        if (mysqli_query($conn, $query)) {
            header("Location: main.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}

?>