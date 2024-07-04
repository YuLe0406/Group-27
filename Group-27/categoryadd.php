<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"];
    $sql = "INSERT INTO manage_categories (name) VALUES ('$category_name')";
    
    if (mysqli_query($conn, $sql)) {
        
        header("Location: manage_categories.php");
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
    <title>Add New Category</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Add New Category</h1>
    </header>
    <main>
        <form method="post" action="">
            <p><label>Category Name:</label><input type="text" name="category_name" required></p>
            <p><button type="submit" name="add_category">Add Category</button></p>
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
