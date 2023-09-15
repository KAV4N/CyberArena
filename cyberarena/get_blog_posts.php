<style>
  .image-blog-link{
      width: 155px;
      height: 155px;
  }

  .creation-date{
      padding-top: 10px;
      font-size: 12px;
  }

  /* Desktop styles */
  @media screen and (min-width: 1024px) {
    .image-blog-link{
        display: block;
    }
  }

  @media screen and (min-width: 768px) and (max-width: 1023px) {
    .image-blog-link{
        display: none;
    }
  }

  /* Tablet styles */
  @media screen and (max-width: 767px) {
    .image-blog-link{
        display: none;
    }
  }
</style>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cyberarena";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve blog posts from the database
/*
$date = date('Y-m-d H:i:s');

$sql_blog = "INSERT INTO blog_posts (title, content, author_id, created_at,category_id,blog_picture,blog_video) VALUES ('Virus', 'wheeeeeeeeeeeee', 1, '$date',2,'https://www.lifewire.com/thmb/wt75J7f72UaQ3Talhk7_L1B7gwo=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/how-to-tell-if-your-pc-has-a-virus-4590200-0-26a9bbbdc3d64c12950a58506fd9aaf7.jpg','https://www.youtube.com/embed/soZyb6lMx4c')";
mysqli_query($conn, $sql_blog);

*/
$sql = "SELECT blog_posts.id_blog, blog_posts.title, blog_posts.blog_picture, blog_posts.blog_video, blog_posts.content, users.username, blog_posts.created_at, categories.id_category, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories
    FROM blog_posts
    INNER JOIN users ON blog_posts.author_id = users.id_user
    LEFT JOIN categories ON blog_posts.category_id = categories.id_category WHERE categories.name = 'Attack' or categories.name = 'Vulnerability'
    GROUP BY blog_posts.id_blog, categories.id_category
    ORDER BY blog_posts.created_at DESC
    LIMIT 10";



$result = mysqli_query($conn, $sql);
// Generate HTML code for blog posts
include "generate_page.php";

  

mysqli_close($conn);
?>