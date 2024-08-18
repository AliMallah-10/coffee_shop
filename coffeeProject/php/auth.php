<?php
session_start();

function check_user_role($required_role) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: ../signin.php");
        exit();
    }
    
    if ($_SESSION['role'] != $required_role) {
        header("Location: ../index.php");
        exit();
    }
}
?>
