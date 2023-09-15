<?php
session_start();
if (isset($_SESSION["user"]) && isset($_POST["submit"])){
    if ($_POST["submit"] == "blogdone"){
        include "connect_to_database.php";
        $conn = get_connection();
        
        $user_id = $_SESSION["user"]["id_user"];
        $date = date('Y-m-d H:i:s');
        
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $content = mysqli_real_escape_string($conn, $_POST["content"]);
        $blog_picture = mysqli_real_escape_string($conn, $_POST["blogpic"]);
        $blog_video = mysqli_real_escape_string($conn, $_POST["blogvid"]);
        $blog_category = mysqli_real_escape_string($conn, $_POST["blogcat"]);

        $query_get_cat = "SELECT * FROM categories WHERE name='$blog_category'";
        $blog_category_id = (int)mysqli_fetch_assoc(mysqli_query($conn, $query_get_cat))["id_category"];

        $sql_blog = "INSERT INTO blog_posts (title, content, author_id, created_at,category_id,blog_picture,blog_video) VALUES ('$title', '$content', '$user_id', '$date','$blog_category_id','$blog_picture','$blog_video')";
        mysqli_query($conn, $sql_blog);
        header("Location: user_info.php");
        exit();
       
    }
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
                    <form  method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                        <h1>Picture link:</h1>
                        <textarea name="blogpic" required> </textarea><br>

                        <h1>Title:</h1>
                        <textarea name="title" required></textarea><br>

                        <h1>Content:</h1>
                        <textarea name="content" required></textarea><br>

                        <h1>Video link:</h1>
                        <textarea name="blogvid" ></textarea><br>
                        <div style="display:flex;">
                            <label for="blogcat" style="margin: 10px;">Category:</label>
                            <select name="blogcat" id="blog_cat" style="height:30px;margin: 10px;">
                                <?php
                                session_start();
                                    if (isset($_SESSION["user"])){
                                        require_once "connect_to_database.php";
                                        $user = $_SESSION["user"];
                                        $conn = get_connection();
                                        if ($user["id_role"]==3){
                                            $query = 'SELECT * FROM categories WHERE name="Community"';
                                            
                                        }
                                        else{

                                            $query = 'SELECT * FROM categories';
                                        }
                                        
                                        $result = mysqli_query($conn,$query);
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
            
                                        }
                                        mysqli_close($conn);
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="blogdone">Create</button>
                            <a class="cancel-btn" href="user_info.php">Cancel</a>
                        </div>
                    </form>
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


