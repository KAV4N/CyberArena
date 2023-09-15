<!DOCTYPE html>
<?php include "auth_controller.php"?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        
    </head>
    <style>
        * {
        box-sizing: border-box;
        font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            margin: 50px auto;
            max-width: 500px;
            padding: 20px;
        }
        body{
            background-image: url("icon/side_bar.jpg"); 
	        background-repeat: repeat;  
        }

        h1 {
            color: black;
            font-size: 24px;
            margin: 0 0 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            color: black;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            padding: 14px 15px;
            width: 100%;
        }

        button[type="submit"] {
            background-color: var(--fg-color);
            color: var(--text-color);

            font-size: 17px;
            border-radius: 3px;
            padding: 14px 15px;

            cursor: pointer;
            border: 1px solid var(--fg-color);
            margin-top: 20px;
  
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: var(--fg-light-color);
        }

        .next-button{
            border-radius: 3px;
            color: #aaa;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            text-align: center;
            border: 1px solid #aaa;
        }

        .next-button:hover{
            background: #aaa;
            color: white;
        }


        p{
            color: #cccccc;
            text-align: center;
            margin: 7px;
        }
        
        .back-button{
            color: #aaa;
            font-size: 30px;
            text-decoration: none;
            text-align: center;
            
        }

        .back-button:hover{
            color: black;
        }
    </style>
    <body>
        <div class="container">
            <a class="back-button"href="main.php">&times;</a>
            <h1>Create account!</h1>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" value="signup">Sign Up</button>
                    <p>-- or --</p>
                    <a class="next-button"href = "login.php">Log In</a>
                </div>

            </form>
            
        </div>
    </body>
</html>