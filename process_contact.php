<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Validate and sanitize the data as per your requirements

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'contacts';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

	header("Location: contact.php");
    exit();
}
?>





<html>
<head>
	<title>Contact Us - Travel Booking Platform</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	
	
	<main>
		<section class="contact-section">
			<h1>Contact Us</h1>
			<p>Feel free to reach out to us for any inquiries or assistance.</p>
			<form method="post">
				<label for="name">Name:</label>
				<input type="text" id="name" name="name" required>
				
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" required>
				
				<label for="message">Message:</label>
				<textarea id="message" name="message" required></textarea>
				<form method="post" action="process_contact.php">


				<input  type="submit" value="Submit">
				
		</section>
	</main>
	<footer>
		<p>&copy; 2023 Travel Booking Platform. All rights reserved.</p>
	</footer>
</body>
</html>


<style>


body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}

header {
	background-color: #333;
	color: #fff;
	padding: 20px;
}

nav ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
}

nav ul li {
	display: inline-block;
	margin-right: 10px;
}

nav ul li a {
	color: #fff;
	text-decoration: none;
	padding: 5px;
}

nav ul li a.active {
	border-bottom: 2px solid #fff;
}

main {
	margin: 40px;
}

.contact-section {
	max-width: 600px;
	margin: 0 auto;
}

.contact-section h1 {
	font-size: 28px;
	margin-bottom: 10px;
}

.contact-section p {
	margin-bottom: 20px;
}

.contact-section label {
	display: block;
	margin-bottom: 5px;
	font-weight: bold;
}

.contact-section input[type="text"],
.contact-section input[type="email"],
.contact-section textarea {
	width: 100%;
	padding: 10px;
	margin-bottom: 10px;
	border: 1px solid #ccc;
	border-radius: 4px;
}

.contact-section textarea {
	height: 150px;
}

.contact-section input[type="submit"] {
	background-color: #4CAF50;
	color: #fff;
	border: none;
	border-radius: 4px;
	padding: 10px 20px;
	cursor: pointer;
}

footer {
	background-color: #333;
	color: #fff;
	padding: 10px;
	text-align: center;
}

</style>



