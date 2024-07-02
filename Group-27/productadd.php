<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $price = floatval($_POST["price"]);
    $store = intval($_POST["store"]);
    $category_id = intval($_POST["category_id"]);
    
    $picture = "";
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $picture = basename($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], "uploads/" . $picture);
    }

    $sql = "INSERT INTO manage_products (name, price, store, category_id, picture) VALUES ('$product_name', $price, $store, $category_id, '$picture')";
    
    if (mysqli_query($conn, $sql)) {
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
        <form method="post" action="" enctype="multipart/form-data">
            <p><label>Product Name:</label><input type="text" name="product_name" required></p>
            <p><label>Price:</label><input type="text" name="price" required></p>
            <p><label>Store:</label><input type="text" name="store" required></p>
            <p>
                <label>Category:</label>
                <select name="category_id" required>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
                    $categories_result = mysqli_query($conn, "SELECT * FROM manage_categories");
                    while ($category_row = mysqli_fetch_assoc($categories_result)) {
                        echo "<option value='" . $category_row['category_id'] . "'>" . $category_row['name'] . "</option>";
                    }
                    mysqli_close($conn);
                    ?>
                </select>
            </p>
            <p><label>Picture:</label><input type="file" name="picture" required></p>
            <p><button type="submit" name="add_product">Add Product</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>