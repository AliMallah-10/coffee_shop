<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    
    include '../config.php';


    // Fetch user details for confirmation message
    $stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name);

    // Display confirmation prompt using JavaScript
    echo "<script>";
    echo "var confirmDelete = confirm('Are you sure you want to delete user $name?');";
    echo "if (confirmDelete) {";
    echo "    window.location.href = 'process_delete_user.php?user_id=$user_id';";
    echo "} else {";
    echo "    window.location.href = 'admin_dashboard.php';";
    echo "}";
    echo "</script>";

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
