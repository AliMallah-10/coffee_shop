<?php
include '../config.php';

$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["menu_id"] . "</td>"; 
        echo "<td><img class='ImageMenu' src='../../image/" . $row["image_url"] . "' alt='" . $row["name"] . "' width='50'></td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>$" . $row["price"] . "</td>";
        echo "<td>";
        echo "<button class='FetchBtn' onclick=\"openModal('" . $row["menu_id"] . "', '" . $row["name"] . "', '" . $row["description"] . "', '" . $row["price"] . "', '" . $row["image_url"] . "')\">Update</button>";
        echo '<a class="DBtn" href="delete_menu.php?menu_id=' . $row['menu_id'] . '">Delete</a>';
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results found</td></tr>";
}
$conn->close();
?>
