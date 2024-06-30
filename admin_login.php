<?php
$admin_username = "admin";
$admin_password = "12345";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION["admin"] = $username;
        echo "Admin login successful!";
    } else {
        echo "Invalid admin credentials.";
    }
}
?>
