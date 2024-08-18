<?php
session_start();
include 'config.php';

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $address = sanitize_input($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 0;

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Email already exists.";
        } else {
            $stmt->close();
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, address, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $name, $email, $address, $hashed_password, $role);
            if ($stmt->execute()) {
                header("Location: ../html/signin.html");
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style22.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Address" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>

            <button type="submit">Submit</button>
        </form>
        <h3>Have an Account? <a href="./signin.php">Sign In</a></h3>
        <?php if ($error_message): ?>
            <p id="error_message" style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
