<?php
include '../config.php';

$sql = "
    SELECT 
        orders.order_id, 
        orders.user_id, 
        orders.menu_id, 
        orders.location, 
        orders.quantity, 
        orders.total_price, 
        users.name AS user_name,
        menu_items.name AS menu_name,
        menu_items.price AS menu_price,
        orders.order_date
    FROM 
        orders 
    JOIN 
        menu_items ON orders.menu_id = menu_items.menu_id
    JOIN 
        users ON orders.user_id = users.user_id
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["menu_name"] . "</td>";
        echo "<td>" . $row["menu_price"] . "</td>";
        echo "<td>" . $row["order_date"] . "</td>";
        echo "<td>" . $row["location"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["total_price"] . "</td>"; // Display total price
        echo "<td>";
        echo "<button class='FetchBtn' onclick=\"openModalOrders('" . $row["order_id"] . "', '" . $row["menu_id"] . "', '" . $row["user_id"] . "',  '" . $row["location"] . "','" . $row["quantity"] . "', '" . $row["total_price"] . "')\">Update</button>";
        echo '<a class="DBtn" href="delete_order.php?order_id=' . $row['order_id'] . '">Delete</a>';
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No results found</td></tr>"; // Adjusted colspan to 9
}
$conn->close();


?>
