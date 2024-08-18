<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_id = $_POST['menu_id'];
    $quantity = $_POST['quantity_in_stock'];
    $inventory_id = $_POST['inventory_id'];  // Make sure to include this field in your form

    // Update SQL query
    $sql = "UPDATE inventory SET menu_id=?, quantity_in_stock=? WHERE inventory_id=?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $menu_id, $quantity, $inventory_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: inv_management.php");
        exit();
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: inv_dashboard.php");
    exit();
}
?>
