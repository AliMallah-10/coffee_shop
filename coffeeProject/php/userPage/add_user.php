<?php
session_start(); // Start the session

include '../config.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $address = sanitize_input($_POST['address']);
    $password = $_POST['password']; // Do not use htmlspecialchars on the password
    $role = sanitize_input($_POST['role']);; // Default role (user)

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, address, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $email, $address, $password, $role);

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
}
?>
