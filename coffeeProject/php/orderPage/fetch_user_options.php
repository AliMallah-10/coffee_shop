<?php
include '../config.php'; // Include your database connection file

$query = "SELECT user_id, name FROM users";
$result = $conn->query($query);

$options = "";
if ($result->num_rows > 0) {
    $options .= '<option value="">Choose User for Order</option>'; // Default option
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['user_id']}'>{$row['name']}</option>";
    }
}

$conn->close();
echo $options;
?>
