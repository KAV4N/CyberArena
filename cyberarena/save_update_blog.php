<?php
if(isset($_POST['submit']) && $_POST['submit'] == 'updateblog' && isset($_GET["id"])) {


    // Create connection
    require_once "connect_to_database.php";
    $conn = get_connection();
    if($conn) {
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $content = mysqli_real_escape_string($conn, $_POST["content"]);
        $blog_picture = mysqli_real_escape_string($conn, $_POST["blogpic"]);
        $blog_video = mysqli_real_escape_string($conn, $_POST["blogvid"]);
        $category = mysqli_real_escape_string($conn, $_POST["blogcat"]);
    
        $date = date('Y-m-d H:i:s');
        $id = $_GET['id'];

        $query_get_cat = "SELECT * FROM categories WHERE name='$category'";
        $blog_category_id = (int)mysqli_fetch_assoc(mysqli_query($conn, $query_get_cat))["id_category"];

        $query = "UPDATE blog_posts SET title = '$title', content = '$content', category_id = '$blog_category_id', blog_picture = '$blog_picture', blog_video = '$blog_video', created_at='$date' WHERE id_blog = '$id'";
        $result = mysqli_query($conn, $query);

        if($result) {
            echo '<p>Blog post updated successfully.</p>';
        } else {
            echo '<p>Error updating blog post: ' . mysqli_error($conn) . '</p>';
        }

        mysqli_close($conn);
        header("Location: main.php");
        exit();
    }
}

?>