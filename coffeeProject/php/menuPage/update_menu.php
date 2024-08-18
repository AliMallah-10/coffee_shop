<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['menu_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "../../image/".basename($image);

    if ($image && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "UPDATE menu_items SET name='$name', description='$description', price='$price', image_url='$image' WHERE menu_id='$id'";
    } else {
        $sql = "UPDATE menu_items SET name='$name', description='$description', price='$price' WHERE menu_id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: menu_management.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
