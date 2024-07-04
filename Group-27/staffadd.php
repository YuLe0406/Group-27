<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $role = $_POST["role"];

    $sql = "INSERT INTO manage_staff (name, role) VALUES ('$name', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_staff.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Staff</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Add New Staff</h1>
    </header>
    <main>
        <form method="post" action="">
            <p><label>Name:</label><input type="text" name="name" required></p>
            <p><label>Role:</label><input type="text" name="role" required></p>
            <p><button type="submit" name="add_staff">Add Staff</button></p>
        </form>
    </main>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
