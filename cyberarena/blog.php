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
    <main class="container">
      
    <section class="section-news">
        <div class="container-cyber-attack">
            <div class="container-blog">
                <?php include "get_content_blog.php"; ?>
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