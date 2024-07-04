<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["edit"])) {
    $catid = $_GET["catid"];
    $result = mysqli_query($conn, "SELECT * FROM manage_categories WHERE category_id = $catid");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Error: " . mysqli_error($conn));
    }
}

if (isset($_POST["savebtn"])) {
    $catid = $_POST["catid"];
    $category_name = mysqli_real_escape_string($conn, $_POST["category_name"]);

    $sql = "UPDATE manage_categories SET name='$category_name' WHERE category_id=$catid";
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_categories.php");
        exit();
    } else {
        echo "Error updating category: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Edit Category</h1>
    </header>
    <main>
        <?php if (isset($row)): ?>
        <form method="post" action="">
            <p>
                <label>Category Name:</label>
                <input type="text" name="category_name" required value="<?php echo htmlspecialchars($row['name']); ?>">
            </p>
            <input type="hidden" name="catid" value="<?php echo $catid; ?>">
            <p><button type="submit" name="savebtn">Update Category</button></p>
        </form>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>