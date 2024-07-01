<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET["edit"])) {
        $prodid = $_GET["prodid"];
        $result = mysqli_query($conn, "SELECT * FROM manage_products WHERE product_id = $prodid");

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            die("Error: " . mysqli_error($conn));
        }
    ?>
    <h1>Edit Product</h1>
    <form name="editfrm" method="post" action="">
        <p><label>Product Name:</label><input type="text" name="product_name" size="80" value="<?php echo htmlspecialchars($row['name']); ?>"></p>
        <p><label>Price:</label><input type="text" name="price" size="80" value="<?php echo htmlspecialchars($row['price']); ?>"></p>
        <p><label>Store:</label><input type="text" name="store" size="80" value="<?php echo htmlspecialchars($row['store']); ?>"></p>
        <p>
            <label>Category:</label>
            <select name="category_id">
                <?php
                // Fetch categories from database
                $categories_result = mysqli_query($conn, "SELECT * FROM manage_categories");
                while ($category_row = mysqli_fetch_assoc($categories_result)) {
                    $selected = ($category_row['category_id'] == $row['category_id']) ? 'selected' : '';
                    echo "<option value='" . $category_row['category_id'] . "' $selected>" . $category_row['name'] . "</option>";
                }
                ?>
            </select>
        </p>
        <p><input type="hidden" name="productid" value="<?php echo $productid; ?>"></p>
        <p><input type="submit" name="savebtn" value="UPDATE PRODUCT"></p>
    </form>
    <?php
    }

    if (isset($_POST["savebtn"])) {
        $productid = $_POST["productid"];
        $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
        $price = floatval($_POST["price"]);
        $store = intval($_POST["store"]);
        $category_id = intval($_POST["category_id"]);

        $sql = "UPDATE manage_products SET name='$product_name', price=$price, store=$store, category_id=$category_id WHERE product_id=$prodid";
        if (mysqli_query($conn, $sql)) {
            ?>
            <script type="text/javascript">
                alert("Product Updated");
                window.location.href = "manage_products.php";
            </script>
            <?php
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</div>
</body>
</html>
