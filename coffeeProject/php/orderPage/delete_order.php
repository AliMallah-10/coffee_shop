<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    
    include '../config.php';

    // Display confirmation prompt using JavaScript
    echo "<script>";
    echo "var confirmDelete = confirm('Are you sure you want to delete this order?');";
    echo "if (confirmDelete) {";
    echo "    window.location.href = 'process_delete_order.php?order_id=$order_id';";
    echo "} else {";
    echo "    window.location.href = 'order_management.php';";
    echo "}";
    echo "</script>";

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: order_management.php");
    exit();
}
?>
