

<?php

if (isset($_SESSION["user"])&&isset($_POST["submit"])){
  include "update_user_info.php";
  if ($_POST["submit"]=="change"){
    echo '
    <style>
      .container-user-info-holder{
        display: none;
      }
      label {
        padding-top: 25px;
    }
    </style>

    <label for="imagelink">Change link to picture:</label>
    <input type="text" id="imagelink" name="profilepic" value="'.$_SESSION["user"]["profile_picture"].'">
  
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="'.$_SESSION["user"]["username"].'" required>
  
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="'.$_SESSION["user"]["password"].'" required>
  
    <label for="bio">Bio:</label>
    <textarea name="bio" value="'.$_SESSION["user"]["bio"].'">'.$_SESSION["user"]["bio"].'</textarea>
    <div class="form-group">
        <button type="submit" name="submit" value="update">Update</button>
        <a class="cancel-btn" href="user_info.php">Cancel</a>
    </div>';
  }
  
} 

  
?>