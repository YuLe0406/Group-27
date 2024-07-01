<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $store = $_POST["store"];
    $category_id = $_POST["category_id"];

    // Insert new product into database
    $sql = "INSERT INTO manage_products (name, price, store, category_id) VALUES ('$product_name', $price, $store, $category_id)";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_products.php after successful insertion
        header("Location: manage_products.php");
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
    <title>Add New Product</title>
    <link rel="stylesheet" href="manage_products.css">
</head>
<body>
    <header>
        <h1>Add New Product</h1>
    </header>
    <main>
        <form method="post" action="">
            <p><label>Product Name:</label><input type="text" name="product_name" required></p>
            <p><label>Price:</label><input type="number" step="0.01" name="price" required></p>
            <p><label>Store:</label><input type="number" name="store" required></p>
            <p>
                <label>Category:</label>
                <select name="category_id" required>
                    <?php
                    // Fetch categories from database
                    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
                    $result = mysqli_query($conn, "SELECT * FROM manage_categories");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                    }
                    mysqli_close($conn);
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
