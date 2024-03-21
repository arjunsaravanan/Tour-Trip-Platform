<?php

session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Read from database
        $query = "SELECT * FROM users WHERE user_name = ? LIMIT 1";

        // Using prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $user_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // Verify password using password_verify for secure password handling
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die();
            } else {
                echo "Wrong username or password!";
            }
        } else {
            echo "Wrong username or password!";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid input!";
    }
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

                <input type="text" placeholder="username" name="user_name" required>
				<input type="text" placeholder="password" name="password" required>
			

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>