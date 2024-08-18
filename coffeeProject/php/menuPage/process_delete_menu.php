
<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['menu_id'])) {
    $user_id = $_GET['menu_id'];

    // Database configuration
    include '../config.php';

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE menu_id = ?");
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: menu_management.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: menu_management.php");
    exit();
}
?>
