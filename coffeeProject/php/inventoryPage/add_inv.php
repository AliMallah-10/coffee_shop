<?php
session_start(); // Start the session

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_id = $_POST['menu_id'];
    $quantity_in_stock = $_POST['quantity_in_stock'];

    $sql = "INSERT INTO inventory (menu_id, quantity_in_stock) VALUES ('$menu_id', '$quantity_in_stock')";

    if ($conn->query($sql) === TRUE) {
        header('Location: inv_management.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
