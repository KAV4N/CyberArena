<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CyberArena</title>
    <link rel="stylesheet" href="style.css">
    <script src="menu.js"></script>
  </head>
  <style>
        .form-group {
            margin-bottom: 10px;
        }
        
        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],input[type="email"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            padding: 10px;
            width: 100%;
        }

        button[type="submit"] {
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
        textarea {
          border-radius: 3px;
          height: auto;
          width: 75%;
          resize: vertical;
          font-size: 16px;
        }
        .profile-image{
          width: 100px;
          height: 100px;
        }
        .container-profile-info{
          margin: 5px;
          border-radius: 3px;
          padding: 14px 15px;
          border: 1px solid var(--text-color);
        }
        #emailmanage{
            border: 0px;
            background: var(--bg-shadow-color);
            font-size: 17px;
            color: var(--text-color);
        }
    </style>
  <?php include "header.php"?>
  <body>
    <?php include_once "installer.php"?>
    <main class="container">
      <section class="section-news">
        <div class="container-cyber-attack">
            <div class="container-blog">
                <h1>User info</h1>
                <form  method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                  <?php
                    include "connect_to_database.php";
                    include "manage_users.php";
                    include "change_user_info.php";
                    include "delete_account_login.php";
                    if (isset($_SESSION["user"])){
                      $query = 'SELECT role_name FROM roles
                        INNER JOIN users ON roles.id_role = users.id_role
                        WHERE users.id_user = '.$_SESSION["user"]["id_user"].'';
                      
                      $conn = get_connection();
                      $result = mysqli_query($conn, $query);
                      if (!$result) {
                        die('Query failed: ' . mysqli_error($conn));
                      }
                      $role_name = mysqli_fetch_assoc($result)['role_name'];
                      echo '
                      <div class="container-user-info-holder">
                        <div class="container-profile-info">
                          <label>E-mail:</label>
                          <select  id="emailmanage" name="emailmanage" style="padding: 10px;">
                            <option name="roleselect" value="'.$_SESSION["user"]["email"].'" selected>'.$_SESSION["user"]["email"].'</option>
                          </select>
                        </div>
    
                        <div class="container-profile-info">
                          <label >Username:</label>
                          <p>'.$_SESSION["user"]["username"].'</p>
                        </div>
                        
                        <div class="container-profile-info">
                          <label >Points:</label>
                          <p>'.$_SESSION["user"]["points"].'</p>
                        </div>

                        <div class="container-profile-info">
                          <label>Bio:</label>
                          <p>'.nl2br($_SESSION["user"]["bio"]).'</p>
                        </div>
                     
                      <div>
                        <div style="display: flex;">
                          <a class="cancel-btn" href="create_blog.php">Create blog</a>
                      ';

                      if ($_SESSION["user"]["id_role"]==1){
                        echo '<button type="submit" name="submit" value="manageusers">Manage users</button>';
                      }

                      echo '
                      </div>
                        <button type="submit" name="submit" value="change">Change information</button>
                      </div>
                      </div>
                      <p style="padding-left: 10px;">Role: '.$role_name.'</p>
                      <p style="padding-left: 10px;">Join date: '.$_SESSION["user"]["join_date"].'</p>';
                      
                      if($_SESSION["user"]["id_role"]!=1){
                        echo '<button type="submit" name="submit" value="deleteaccount" style="background: #dd0000; border: 0px;">Delete</button>';
                      }
                    
                      mysqli_close($conn);
                    }

                    else{
                      echo "Permision denied!";
                    }
                    
                  ?>
                </form>
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