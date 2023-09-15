


<div class="login-box">
    <?php
        if (isset($_SESSION["user"])){
            $user = $_SESSION["user"];
            echo '
            <a href="user_info.php" style="width:80px;height:80px;margin:auto;padding:0px; border-radius:10px ">
                <img src="'.$user["profile_picture"]. '"style="width:100%;height:100%;border: 1px solid var(--fg-color); border-radius:10px">
            </a><br>';
        }
    
    ?>
    <a href="logout.php" style="text-align: center;border: 1px solid var(--fg-color); border-radius:5px;">Log Out</a>
</div>