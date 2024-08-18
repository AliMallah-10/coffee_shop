<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];

    
    include '../config.php';


    // Fetch user details for confirmation message
    $stmt = $conn->prepare("SELECT name FROM menu_items WHERE menu_id = ?");
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name);

    // Display confirmation prompt using JavaScript
    echo "<script>";
    echo "var confirmDelete = confirm('Are you sure you want to delete this Item $name?');";
    echo "if (confirmDelete) {";
    echo "    window.location.href = 'process_delete_menu.php?menu_id=$menu_id';";
    echo "} else {";
    echo "    window.location.href = 'menu_management.php';";
    echo "}";
    echo "</script>";

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: menu_management.php");
    exit();
}
?>
