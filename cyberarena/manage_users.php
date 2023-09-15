<?php
require_once("connect_to_database.php");
if (isset($_SESSION["user"]) && isset($_POST["submit"])) {
    include "change_role.php";
    include "delete_account.php";
    $conn = get_connection();
    $cur_user = $_SESSION["user"];
    $cur_email = $cur_user["email"];
    if ($_POST["submit"] == "manageusers") {
        echo "
        <style>
            .container-user-info-holder{
                display: none;
            }
            label {
                padding-top: 25px;
            }
            #emailmanage{
                border: 0px;
                background: var(--bg-shadow-color);
                font-size: 15px;
                color: var(--text-color);
            }
        </style>
        ";

        $query = "SELECT * FROM users WHERE email!='$cur_email'";
        $query_cat = 'SELECT * FROM roles';

        $result = mysqli_query($conn, $query);

        while ($user = mysqli_fetch_assoc($result)) {

            $poz = 1;
            $result_cat = mysqli_query($conn,$query_cat);
            echo '

            <form method="post" action="'.$_SERVER["PHP_SELF"].'">
                <div class="container-user-manage" style=" border: 1px solid var(--text-color); border-radius: 3px; margin:5px;">
                    <img src="' . $user["profile_picture"] . '" style="width:70px;height:70px;">
                    <select  id="emailmanage" name="emailmanage" style="padding: 10px;">
                        <option name="roleselect" value="'.$user["email"].'" selected>'.$user["email"].'</option>
                    </select>
                    <button type="submit" name="submit" value="delete" style="background: #dd0000; border: 0px;margin:auto; margin-left: 15px;">Delete</button>
                    <div style="padding:5px;">
                        <select name="blogcat" id="blog-cat" style="height:40px;width:80px;margin: 10px;">';
            while ($row = mysqli_fetch_assoc($result_cat)) {
                if ($poz == $user["id_role"]){
                    echo '<option name="roleselect" value="'.$row["role_name"].'" selected>'.$row["role_name"].'</option>';
                }
                else{
                    echo '<option name="roleselect" value="'.$row["role_name"].'">'.$row["role_name"].'</option>';
                }
                $poz++;
            }
            echo '      </select>
                    <button type="submit" name="submit" value="saveusers" style="margin: auto;">Save</button>
                    </div>
                </div>
            </form>';
        }

        
    }
    mysqli_close($conn);
}
?>
