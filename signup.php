<?php

session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Hash the password before saving it to the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $query = "INSERT INTO users (user_name, password) VALUES (?, ?)";

    // Using prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $user_name, $hashed_password);
    
    if (mysqli_stmt_execute($stmt)) {
        // Registration successful
        echo "Signup successful! You can now <a href='login.php'>login</a>.";
    } else {
        // Registration failed
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">

body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    #box {
        width: 250px;
        margin: 90px auto;
        padding: 50px;
        background-color: #333;
        border-radius: 5px;
    }

    #box form {
        text-align: center;
    }

    #box form div {
        font-size: 20px;
        margin: 20px;
        color: white;
    }

    #box input[type="text"],
    #box input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: none;
    }

    #box input[type="submit"] {
        width: 50%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #box input[type="submit"]:hover {
        background-color: #45a049;
    }

    #box a {
        color: white;
        text-decoration: none;
    }

    #box a:hover {
        text-decoration: underline;
    }
</style>
	




	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input type="text" placeholder="username" name="user_name" required>
			<input type="text" placeholder="password" name="password" required>
			


			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>