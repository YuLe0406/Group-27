<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];

    $sql = "INSERT INTO manage_products (name, price, category_id) VALUES ('$product_name', '$price', '$category_id')";
    
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
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Add New Product</h1>
    </header>
    <main>
        <form method="post" action="">
            <p><label>Product Name:</label><input type="text" name="product_name" required></p>
            <p><label>Price:</label><input type="text" name="price" required></p>
            <p><label>Category ID:</label><input type="text" name="category_id" required></p>
            <p><button type="submit" name="add_product">Add Product</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
