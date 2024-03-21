<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trip_dbase";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if (isset($_POST['place']) && isset($_POST['date']) && isset($_POST['person']) && isset($_POST['totalprice'])) {
    $place = $_POST['place'];
    $date = $_POST['date'];
    $person = $_POST['person'];
    $totalPrice = $_POST['totalprice'];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO bookings (place, date, person, totalprice) VALUES ('$place', '$date', '$person', '$totalPrice')";
    if ($conn->query($sql) === true) {
        // Store booking data in session variables
        $_SESSION['booking_place'] = $place;
        $_SESSION['booking_date'] = $date;
        $_SESSION['booking_person'] = $person;
        $_SESSION['booking_total_price'] = $totalPrice;

        header("Location: confirmation.php"); // Redirect to the confirmation page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

// Close the connection
$conn->close();
?>






<html>
<head>
    <title>Travel Booking</title>
    <style>
    

        #box {
            background-color: black;
            margin: 0 auto;
            max-width: 400px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-heading {
            font-size: 20px;
            margin: 10px;
            color: tomato;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color:gold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 30px;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 5px;
            font-size: 14px;
        }

        .form-group input[type="date"] {
            padding: 4px;
        }

        .form-group input[type="submit"] {
            width: auto;
            color: #fff;
            background-color: #4caf50;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

    <div id="box">
    <form class="form" action="process_booking.php" method="post">
   

    <div class="form-heading">Booking</div>
    <div class="form-group">
        <label for="place">Place:</label>
        <input type="text" list="mylist" placeholder="Select a place" name="place" required>
        <datalist id="mylist">
            <option>Taj Mahal</option>
            <option>Colosseum</option>
            <option>Eiffel Tower</option>
            <option>The Pyramid Of Giza</option>
            <option>Leaning Tower Of Pisa</option>
            <option>The Great Wall Of China</option>
            <option>The Empire State Building</option>
        </datalist>
    </div>
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="date" name="date" required>
    </div>
    <div class="form-group">
        <label for="person">Person:</label>
        <input type="text" placeholder="Enter number of persons" name="person" required>
    </div>


    
   
        <div class="form-group">
    <label for="price">Price per person:</label>
    <input type="text" placeholder="Enter price per person" name="price" required>
</div>

<div class="form-group">
    <label for="totalprice">Total Price:</label>
    <input type="text" id="totalprice" name="totalprice" readonly>
</div>
<div class="form-group">
        <input type="submit" value="Book">
        

       
<script>
    // Calculate and update the total price based on the number of persons and price per person
    var priceInput = document.querySelector('input[name="price"]');
    var personInput = document.querySelector('input[name="person"]');
    var totalPriceInput = document.getElementById('totalprice');

    function calculateTotalPrice() {
        var pricePerPerson = parseFloat(priceInput.value);
        var numberOfPersons = parseInt(personInput.value);

        if (!isNaN(pricePerPerson) && !isNaN(numberOfPersons)) {
            var totalPrice = pricePerPerson * numberOfPersons;
            totalPriceInput.value = totalPrice.toFixed(2); // Display the total price with 2 decimal places
        }
    }

    priceInput.addEventListener('input', calculateTotalPrice);
    personInput.addEventListener('input', calculateTotalPrice);

  





  
</script>



  

        </form>
 </div>
        
         
   

  

</body>
</html>





