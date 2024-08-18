<?php
session_start();
include 'config.php';

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password, $role);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $name;
            $_SESSION['userid'] = $id;
            $_SESSION['role'] = $role;
            if ($role === 1) {
                header("Location: ./userPage/admin_dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that email address.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/style22.css">
</head>
<body>
    <div class="container">
        <h2>Sign In</h2>
        <form action="signin.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <button type="submit">Sign In</button>
        </form>
        <h3>Don't have an Account? <a href="./signup.php">SignUp</a></h3>

        <?php if ($error_message): ?>
            <p id="error_message" style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
