<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rating_dbase";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST["rating"];
    $review = $_POST["review"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO reviews (rating, review) VALUES (?, ?)");
    $stmt->bind_param("ss", $rating, $review);

    // Check if the statement is prepared successfully
    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    // Execute the insert statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to a success page or display a success message
    header("Location: success.php");
    exit();
}
?>



<html>
<head>
    <title>Travel Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        h2 {
            margin-bottom: 10px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, textarea {
            width: 100%;
            padding: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Rating for Travel</h1>

    <h2>Submit a Review</h2>

    <form id="review-form" method="post" action="rating.php">
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select><br><br>

        <label for="review">Review:</label><br>
        <textarea id="review" name="review" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Submit Review">
    </form>
</body>
</html>
