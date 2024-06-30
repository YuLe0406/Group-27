<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $category_name = $_POST["category_name"];
    $total = $_POST["total"];

    // Insert new category into database
    $sql = "INSERT INTO manage_categories (name, total) VALUES ('$category_name', $total)";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_categories.php after successful insertion
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
    <link rel="stylesheet" href="manage_categories.css">
</head>
<body>
    <header>
        <h1>Add New Category</h1>
    </header>
    <main>
        <form method="post" action="">
            <p><label>Category Name:</label><input type="text" name="category_name" required></p>
            <p><label>Total:</label><input type="number" name="total" required></p>
            <p><button type="submit" name="add_category">Add Category</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
