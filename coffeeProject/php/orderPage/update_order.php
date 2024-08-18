<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $menu_id = $_POST['menu_id'];
    $user_id = $_POST['user_id'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    
    // Fetch the price of the menu item
    $fetchPriceQuery = "SELECT price FROM menu_items WHERE menu_id = ?";
    $stmt = $conn->prepare($fetchPriceQuery);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt->bind_result($menu_price);
    $stmt->fetch();
    $stmt->close();

    // Update SQL query
    $sql = "UPDATE orders SET menu_id=?, user_id=?, location=?, quantity=?, total_price=? WHERE order_id=?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissdi", $menu_id, $user_id, $location, $quantity, $total_price, $order_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: order_management.php");
        exit();
    } else {
        echo "Error updating order: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: order_dashboard.php");
    exit();
}

?>
