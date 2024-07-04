<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO manage_members (name, email, password) VALUES ('$name', '$email', '$password_hashed')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_members.php");
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
    <title>Add New Member</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Add New Member</h1>
    </header>
    <main>
        <form method="post" action="">
            <p>
                <label>Name:</label>
                <input type="text" name="name" required>
            </p>
            <p>
                <label>Email:</label>
                <input type="email" name="email" required>
            </p>
            <p>
                <label>Password:</label>
                <input type="password" name="password" required>
            </p>
            <p><button type="submit" name="add_member">Add Member</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
