<?php
function get_connection(){
    $con = mysqli_connect("localhost","root","","cyberarena");
    return $con;
}


?>