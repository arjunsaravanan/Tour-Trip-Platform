<?php

function check_login($con, $user_name = null, $password = null)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // If username and password are provided, check for verification
            if ($user_name !== null && $password !== null) {
                if ($user_data['user_name'] === $user_name && password_verify($password, $user_data['password'])) {
                    // User is verified, return user data
                    return $user_data;
                } else {
                    // Invalid credentials, redirect to login
                    header("Location: login.php");
                    die;
                }
            }

            return $user_data;
        }
    }

    // Redirect to login if not logged in
    header("Location: login.php");
    die;
}


