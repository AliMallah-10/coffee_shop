<?php
include './config.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_id = $_POST['menu_id'];
    $user_id = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $location = isset($_POST['location']) ? $_POST['location'] : ''; // Ensure location is set

    // Fetch the price of the menu item
    $fetchPriceQuery = "SELECT price FROM menu_items WHERE menu_id = ?";
    $stmt = $conn->prepare($fetchPriceQuery);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt->bind_result($menu_price);
    $stmt->fetch();
    $stmt->close();

    // Calculate the total price
    $total_price = $menu_price * $quantity;

    // Get the current date and time
    $order_date = date('Y-m-d H:i:s');

    // Check if user_id exists in users table
    $checkUserQuery = "SELECT user_id FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        // User ID does not exist
        echo "Error: User ID does not exist.";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Insert SQL query
    $sql = "INSERT INTO orders (menu_id, user_id, location, quantity, order_date, total_price) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssd", $menu_id, $user_id, $location, $quantity, $order_date, $total_price);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../menu.php");
        exit();
    } else {
        echo "Error adding order: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../menu.php");
    exit();
}
?>
