<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "../../image/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO menu_items (name, description, price, image_url) VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            header("Location: menu_management.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
$conn->close();
?>
