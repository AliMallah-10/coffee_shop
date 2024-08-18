<?php
include '../config.php';

// Fetch users from database
$sql = "SELECT user_id, name, email, address,role FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
     echo "<td>" . $row['role'] . "</td>";
     echo "<td>";
     echo "<button class='Btn' onclick=\"openModalUser('" . $row["user_id"] . "', '" . $row["name"] . "', '" . $row["address"] . "', '" . $row["email"] . "', '" . $row["role"] . "')\">Update</button>";
     echo '<a class="DBtn" href="delete_user.php?user_id=' . $row['user_id'] . '">Delete</a>';
     echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found</td></tr>";
}

// Close connection
$conn->close();
?>
