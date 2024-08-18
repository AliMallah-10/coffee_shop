<?php
include '../config.php'; // Include your database connection file

$query = "SELECT menu_id, name FROM menu_items";
$result = $conn->query($query);

$options = "";
if ($result->num_rows > 0) {
    $options .= '<option value="">Choose menu</option>'; // Default option
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['menu_id']}'>{$row['name']}</option>";
    }
}

$conn->close();
echo $options;
?>
