<?php
include '../config.php';

$sql = "
    SELECT 
        inventory.inventory_id, 
        inventory.menu_id, 
        menu_items.name, 
        inventory.quantity_in_stock 
    FROM 
        inventory 
    JOIN 
        menu_items 
    ON 
        inventory.menu_id = menu_items.menu_id
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["inventory_id"] . "</td>";
        echo "<td>" . $row["menu_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>"; // Display menu_name here
        echo "<td>" . $row["quantity_in_stock"] . "</td>";   
        echo "<td>";
        echo "<button class='FetchBtn' onclick=\"openModalInv('" . $row["inventory_id"] . "', '" . $row["menu_id"] . "', '" . $row["quantity_in_stock"] . "')\">Update</button>";
        echo '<a class="DBtn" href="delete_Inv.php?inventory_id=' . $row['inventory_id'] . '">Delete</a>';
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
$conn->close();
?>
z