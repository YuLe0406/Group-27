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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
    <h1>Edit Product</h1>
    <form name="editfrm" method="post" action="">
        <p><label>Name:</label><input type="text" name="name" size="80" value="<?php echo htmlspecialchars($row['name']); ?>" required></p>
        <p><label>Price:</label><input type="text" name="price" size="80" value="<?php echo htmlspecialchars($row['price']); ?>" required></p>
        <p><label>Store:</label><input type="number" name="store" size="80" value="<?php echo htmlspecialchars($row['store']); ?>" required></p>
        <p>
            <label>Category:</label>
            <select name="category_id" required>
                <?php
                $categories_result = mysqli_query($conn, "SELECT * FROM manage_categories");
                while ($category_row = mysqli_fetch_assoc($categories_result)) {
                    $selected = $row['category_id'] == $category_row['category_id'] ? 'selected' : '';
                    echo "<option value='" . $category_row['category_id'] . "' $selected>" . $category_row['name'] . "</option>";
                }
                ?>
            </select>
        </p>
        <p><input type="submit" name="savebtn" value="UPDATE PRODUCT"></p>
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST["savebtn"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = floatval($_POST["price"]);
    $store = intval($_POST["store"]);
    $category_id = intval($_POST["category_id"]);
    
    $updateQuery = "UPDATE manage_products SET name='$name', price=$price, store=$store, category_id=$category_id WHERE product_id=$product_id";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script type='text/javascript'>alert('Product Updated');</script>";
        header("refresh:0.5; url=manage_products.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
