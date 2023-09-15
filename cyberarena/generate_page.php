<?php

while ($row = mysqli_fetch_assoc($result)) {
    echo '<a href="blog.php?id='. $row["id_blog"] .'" class="blog-link">';
    echo '<img src="' . $row["blog_picture"] . '" class="image-blog-link" id="image-id">';
    echo '<li>';
    echo '<h3>' . $row["title"] . '</h3>';
    echo '<p>Category: ' . $row["categories"] . '</p>';
    echo '<p>Author: ' . $row["username"] . '</p>';
    echo '<p class="creation-date">Created at: '. $row["created_at"] .'</p>';
    echo '</li>';
    echo '</a>';
  }

?>