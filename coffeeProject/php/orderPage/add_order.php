<?php
include '../config.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_id = $_POST['menu_id'];
    $user_id = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $location = isset($_POST['location']) ? $_POST['location'] : ''; // Ensure location is set
    $total_price = $_POST['total_price']; // Get the total_price from the form

    // Get the current date and time
    $order_date = date('Y-m-d H:i:s');

    // Debugging: Print all POST data
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Check if user_id is valid
    if (empty($user_id)) {
        die('Error: User ID is missing. Please log in to place an order.');
    }

    // Insert SQL query
    $sql = "INSERT INTO orders (menu_id, user_id, location, quantity, total_price, order_date) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissds", $menu_id, $user_id, $location, $quantity, $total_price, $order_date);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: order_management.php");
        exit();
    } else {
        echo "Error adding order: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: order_management.php");
    exit();
}
?>
