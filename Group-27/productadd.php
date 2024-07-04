<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $price = floatval($_POST["price"]);
    $category_id = intval($_POST["category_id"]);

    $sql = "INSERT INTO manage_products (name, price, category_id) VALUES ('$product_name', '$price', '$category_id')";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$categories_result = mysqli_query($conn, "SELECT * FROM manage_categories");

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Add New Product</h1>
    </header>
    <main>
        <form method="post" action="">
            <p>
                <label>Product Name:</label>
                <input type="text" name="product_name" required>
            </p>
            <p>
                <label>Price:</label>
                <input type="number" name="price" step="0.01" required>
            </p>
            <p>
                <label>Category:</label>
                <select name="category_id" required>
                    <option value="">Select a category</option>
                    <?php
                    while ($category_row = mysqli_fetch_assoc($categories_result)) {
                        echo "<option value='" . $category_row['category_id'] . "'>" . htmlspecialchars($category_row['name']) . "</option>";
                    }
                    ?>
                </select>
            </p>
            <p><button type="submit" name="add_product">Add Product</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>