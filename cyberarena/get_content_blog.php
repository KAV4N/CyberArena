<style>
        button[type="submit"]:hover {
            background-color: var(--fg-light-color);
        }
        button[type="submit"] {
            background-color: var(--fg-color);
            color: var(--text-color);
            font-size: 17px;
            border-radius: 3px;
            padding: 12px 15px;
            margin:5px;
            cursor: pointer;
            border: 1px solid var(--fg-color);
            margin-top: 20px;
        }
    </style>


<?php
session_start();
// Create connection
require_once "connect_to_database.php";
$conn = get_connection();
if (isset($_SESSION["user"])){
    if(isset($_GET['id'])&&$conn) {
        $id = $_GET['id'];

        $query = "SELECT b.title,b.author_id, b.content, b.blog_picture, b.blog_video, b.created_at, c.name AS category, u.username AS author 
            FROM blog_posts b 
            JOIN categories c ON b.category_id = c.id_category 
            JOIN users u ON b.author_id = u.id_user 
            WHERE b.id_blog = '$id';";
    
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        echo '<div class="image-holder" style="background-image: url('. $row["blog_picture"] .'); "><p></p></div><br>';
        echo '<h2>'. $row["title"] .'</h2>';
        echo '<div><p>'. nl2br($row["content"]).'</p></div><br><br>';

        if ($row["blog_video"]){
            $video_link = $row['blog_video'];
            $parsed_url = parse_url($video_link);
            parse_str($parsed_url['query'], $query_params);
            $video_id = $query_params['v'];
            echo '
            <div style="position: relative; height: 0; padding-bottom: 56.25%; overflow: hidden; ">
  <iframe src="https://www.youtube.com/embed/' . $video_id . '"
    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;max-width:600px;max-height:350px;"
    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
  </iframe>
</div>
';
        /*
            echo '<iframe width="50%" height="400px" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';    
        */
        }
       
            echo '<p> Category: '. $row["category"]. '</p>';
        echo '<p> Author: '. $row["author"]. '</p>'; 
        if ($_SESSION["user"]["id_user"] == $row["author_id"] || $_SESSION["user"]["id_role"] == 1){
            echo '<div style = "display: flex; justify-content: space-between;"> 
            <form method="post" action="update_blog.php?id='.$id.'">
                <button type="submit" name="submit" value="edit" style = "border: 0px;">Edit</button>
            </form>
            <form method="post" action="delete_blog.php?id='.$id.'">
                <button type="submit" name="submit" value="deleteblog" style="background: #dd0000; border: 0px">Delete</button>
            </form>
            </div>';
            
        }
    }
}
else {
    echo '<h1>Log in to view this blog!</h1>';
}
mysqli_close($conn);
?>