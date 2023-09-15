<?php 

if (isset($_SESSION["user"]) && isset($_GET['id'])){
    require_once "connect_to_database.php";
    $conn = get_connection();

    $id = $_GET['id'];
    $query = "SELECT b.title,b.author_id, b.content, b.blog_picture, b.blog_video, b.created_at, c.name AS category, u.username AS author 
    FROM blog_posts b 
    JOIN categories c ON b.category_id = c.id_category 
    JOIN users u ON b.author_id = u.id_user 
    WHERE b.id_blog = '$id';";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    echo "";
    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CyberArena</title>
    <link rel="stylesheet" href="style.css">
    <script src="menu.js"></script>
  </head>
  <?php include "header.php"; ?>
  <body>
    <style>
        .cancel-btn{
          background-color: var(--fg-color);
          color: var(--text-color);
          font-size: 17px;
          border-radius: 3px;
          padding: 14px 15px;
          margin:5px;
          cursor: pointer;
          border: 1px solid var(--fg-color);
          margin-top: 20px;
        }
        .cancel-btn:hover{
          background-color: var(--fg-light-color);
        }
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
        textarea {
          border-radius: 3px;
          height: auto;
          width: 75%;
          font-size: 16px;
          resize: vertical;
        }
    </style>
    <main class="container">
      
    <section class="section-news">
        <div class="container-cyber-attack">
            <div class="container-blog">
                <div>
                
                        <?php 
                        session_start();
                        require_once "connect_to_database.php";
                        $conn = get_connection();
                        if (isset($_SESSION["user"]) && isset($_GET['id'])&&$conn){

                            $id = $_GET['id'];
                            $query = "SELECT b.title,b.author_id, b.content, b.blog_picture, b.blog_video, b.created_at, c.name AS category, u.username AS author 
                            FROM blog_posts b 
                            JOIN categories c ON b.category_id = c.id_category 
                            JOIN users u ON b.author_id = u.id_user 
                            WHERE b.id_blog = '$id';";

                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $user = $_SESSION["user"];

                            echo '
                            <form  method="post" action="save_update_blog.php?id='.$id.'">
                            <h1>Picture link:</h1>
                            <textarea name="blogpic" required>'.$row["blog_picture"].'</textarea><br>
    
                            <h1>Title:</h1>
                            <textarea name="title" required>'.$row["title"].'</textarea><br>
    
                            <h1>Content:</h1>
                            <textarea name="content" required>'.$row["content"].'</textarea><br>
    
                            <h1>Video link:</h1>
                            <textarea name="blogvid">'.$row["blog_video"].'</textarea><br>
                            
                            
                            <div style="display:flex;">
                            <label for="blogcat" style="margin: 10px;">Category:</label>
                            <select name="blogcat" id="blog_cat" style="height:30px;margin: 10px;">';
                            
                            if ($user["id_role"]==3){
                                $query = 'SELECT * FROM categories WHERE name="Community"';
                            }
                            else{
                                $query = 'SELECT * FROM categories';
                            }
                            
                            $result = mysqli_query($conn,$query);
                            while($row_cat = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$row_cat["name"].'"';
                                
                                if ($row["category"]==$row_cat["name"]) {
                                  echo " selected";
                                }
                                echo '>'.$row_cat["name"].'</option>';
                            }  
                            echo '
                            </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" value="updateblog">Update</button>
                                <a class="cancel-btn" href="main.php">Cancel</a>
                            </div>
                        </form>';     
                        }
                        mysqli_close($conn);

                        ?>
                </div>
            </div>
        </div>
      </section>
      <section class="section-user">
      <?php 
      if (isset($_SESSION["user"])){
        include "logout_btn.php"; 
      }
      else{
        include "login_btn.php"; 
      }
      ?>
      </section>

    </main>
    <?php include "footer.php"?>
  </body>
</html>


