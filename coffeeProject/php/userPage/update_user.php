<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $role = $_POST['role']; // Assuming role is also sent via POST

    // Update SQL query
    $sql = "UPDATE users SET name=?, email=?, address=?, role=? WHERE user_id=?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $address, $role, $id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
