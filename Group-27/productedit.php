<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["product_id"])) {
    $product_id = intval($_GET["product_id"]);
    $result = mysqli_query($conn, "SELECT * FROM manage_products WHERE product_id = $product_id");
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["savebtn"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = floatval($_POST["price"]);
    $category_id = intval($_POST["category_id"]);
    
    $updateQuery = "UPDATE manage_products SET name='$name', price=$price, category_id=$category_id WHERE product_id=$product_id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Edit Product</h1>
    </header>
    <main>
        <form method="post" action="">
            <p>
                <label>Name:</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($row['name']); ?>">
            </p>
            <p>
                <label>Price:</label>
                <input type="text" name="price" required value="<?php echo htmlspecialchars($row['price']); ?>">
            </p>
            <p>
                <label>Category:</label>
                <select name="category_id" required>
                    <?php
                    $categories_result = mysqli_query($conn, "SELECT * FROM manage_categories");
                    while ($category_row = mysqli_fetch_assoc($categories_result)) {
                        $selected = $row['category_id'] == $category_row['category_id'] ? 'selected' : '';
                        echo "<option value='" . $category_row['category_id'] . "' $selected>" . htmlspecialchars($category_row['name']) . "</option>";
                    }
                    ?>
                </select>
            </p>
            <p><button type="submit" name="savebtn">Update Product</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
mysqli_close($conn);
?>