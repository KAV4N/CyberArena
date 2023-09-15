<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "cyberarena";

    $username_admin = "pfk02";
    $admin_email = "admin@cyberarena.com";
    $admin_password = password_hash("123456789", PASSWORD_DEFAULT); // replace with your own password
    $admin_join_date = date("Y-m-d H:i:s");
    $admin_role = 1;


    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Create database
    $result = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'");
    if (mysqli_num_rows($result) == 0) {
        // Create database
        $sql = "CREATE DATABASE $db_name";

        $table_roles = "CREATE TABLE `roles` (
            `id_role` INT PRIMARY KEY AUTO_INCREMENT,
            `role_name` VARCHAR(50) NOT NULL
        )";

        $table_users = "CREATE TABLE `users` (
            `id_user` int PRIMARY KEY AUTO_INCREMENT,
            `username` varchar(100) NOT NULL,
            `email` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            `join_date` datetime NOT NULL,
            `points` int NOT NULL DEFAULT '0',
            `bio` text NOT NULL DEFAULT '',
            `profile_picture` text NOT NULL DEFAULT '',
            `id_role` int NOT NULL,
            CONSTRAINT `fk_id_roles` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $table_blogs = "CREATE TABLE `blog_posts` (
            `id_blog` int PRIMARY KEY AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `blog_picture` text NOT NULL DEFAULT '',
            `blog_video` text NOT NULL DEFAULT '',
            `content` text NOT NULL,
            `author_id` int NOT NULL,
            `created_at` datetime NOT NULL,
            `category_id` int NOT NULL,
            KEY `fk_author_id` (`author_id`),
            KEY `fk_category_id` (`category_id`),
            CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        
        $table_categories = "CREATE TABLE `categories` (
            `id_category` int PRIMARY KEY AUTO_INCREMENT,
            `name` varchar(255) NOT NULL
        )";

        $query_admin = "INSERT INTO `users` (`username`, `email`, `password`, `id_role`, `join_date`) 
        VALUES ('$username_admin', '$admin_email', '$admin_password', '$admin_role', '$admin_join_date')";


        if (mysqli_query($conn, $sql)) {
            mysqli_select_db($conn, $db_name);

            if (mysqli_query($conn, $table_roles)) {
                $sql_values = "INSERT INTO `roles` (`role_name`) VALUES ('admin')";
                mysqli_query($conn, $sql_values);
            
                $sql_values = "INSERT INTO `roles` (`role_name`) VALUES ('editor')";
                mysqli_query($conn, $sql_values);
            
                $sql_values = "INSERT INTO `roles` (`role_name`) VALUES ('user')";
                mysqli_query($conn, $sql_values);
            }
            else{
                echo "Table 'users' failed to create<br>";
            }

            if (!mysqli_query($conn, $table_users)) {
                echo "Table 'users' failed to create<br>";
            }
            if (mysqli_query($conn, $table_categories)) {
                $sql_values = "INSERT INTO `categories` (`name`) VALUES ('Attack')";
                mysqli_query($conn, $sql_values);
            
                $sql_values = "INSERT INTO `categories` (`name`) VALUES ('Vulnerability')";
                mysqli_query($conn, $sql_values);
            
                $sql_values = "INSERT INTO `categories` (`name`) VALUES ('Community')";
                mysqli_query($conn, $sql_values);
            }

            if (!mysqli_query($conn, $table_blogs)) {
                echo "Table 'users' failed to create<br>";
            } 
            
            else{
                
                echo "Table 'users' failed to create<br>";
            }
            
            if (!mysqli_query($conn, $query_admin)) {
                echo "Admin account failed to create";
            }
        }
        else {
            echo "Error creating database: " . mysqli_error($conn)."<br>";
        }

    }


    mysqli_close($conn);
?>