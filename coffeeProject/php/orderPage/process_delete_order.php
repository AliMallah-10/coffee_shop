
<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['order_id'])) {
    $user_id = $_GET['order_id'];

    // Database configuration
    include '../config.php';

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: order_management.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: order_management.php");
    exit();
}
?>
