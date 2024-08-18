<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Database configuration
    include '../config.php';

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
