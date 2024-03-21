<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    
    // Validate and sanitize the data as per your requirements

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'personal_details';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO contacts (name, email, phone, country) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $phone, $country);
        // Use "ssss" as the parameter type definition string to match the four bind variables
        // Adjust the type based on the actual data types of your columns
    
        if ($stmt->execute()) {
            echo "Data saved successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $conn->close();
    header("Location: personal.php");
    exit();
}
?>

<html>
<head>
    <title>Personal Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Personal Details</h2>
        <form method="post" action="personal_details.php">
            <div class="form-group">
                <label for="full-name">full_name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name">


            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address">
            </div>
            <div class="form-group">
                <label for="phone">phone</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
            </div>
            <div class="form-group">
                <label for="country">country</label>
                <input type="text" list="mylist" placeholder="Select your country" name="country" required>
                <datalist id="mylist">
                    <option>USA</option>
                    <option>LONDON</option>
                    <option>CANADA</option>
                    <option>AFRICA</option>
                  
                </datalist>
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>




<style>
    .container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

</style>



