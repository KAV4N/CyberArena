
<?php
    if (isset($_POST["submit"])=="login"){
        header("Location: login.php");
        exit();
    }
    else if(isset($_POST["submit"])=="logout"){
        header("Location: main.php");
        session_abort();
        exit();
    }
?>