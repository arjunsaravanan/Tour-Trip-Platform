<?php
session_start();

if (isset($_SESSION['booking_place']) && isset($_SESSION['booking_date']) && isset($_SESSION['booking_person']) && isset($_SESSION['booking_total_price'])) {
    $place = $_SESSION['booking_place'];
    $date = $_SESSION['booking_date'];
    $person = $_SESSION['booking_person'];
    $totalPrice = $_SESSION['booking_total_price'];
    
    // Clear the session variables
    unset($_SESSION['booking_place']);
    unset($_SESSION['booking_date']);
    unset($_SESSION['booking_person']);
    unset($_SESSION['booking_total_price']);
    
    // Display the booking confirmation on the page
    echo '<h2>Booking Confirmation</h2>';
    echo '<p><strong>Place:</strong> ' . $place . '</p>';
    echo '<p><strong>Date:</strong> ' . $date . '</p>';
    echo '<p><strong>Person:</strong> ' . $person . '</p>';
    echo '<p><strong>Total Price:</strong> ' . $totalPrice . '</p>';
} else {
    echo 'Booking data not found.';
}
?>



