<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['inventory_id'])) {
    $inventory_id = $_GET['inventory_id'];

    
    include '../config.php';

    // Display confirmation prompt using JavaScript
    echo "<script>";
    echo "var confirmDelete = confirm('Are you sure you want to delete this inventory?');";
    echo "if (confirmDelete) {";
    echo "    window.location.href = 'process_delete_Inv.php?inventory_id=$inventory_id';";
    echo "} else {";
    echo "    window.location.href = 'inv_management.php';";
    echo "}";
    echo "</script>";

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: inv_management.php");
    exit();
}
?>
