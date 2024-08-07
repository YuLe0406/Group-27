<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pepe_sportshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from query parameter
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 3;

// Fetch product data
$sql = "SELECT name, price, store FROM manage_products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($name, $price, $store);
$stmt->fetch();
$stmt->close();

$conn->close();

// Hardcoded descriptions and specifications for the product
$description = "The Lining ATSS993 shirt is designed for comfort and performance. Its lightweight fabric ensures you stay cool and dry during your games.";
$specifications = [
    "Material: Polyester",
    "Color: White/Red",
    "Available Sizes: S, M, L, XL"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($name); ?> - Product Lining ATSS993</title>
    <link rel="stylesheet" href="product_detail.css">
    <script src="cart.js"></script>
</head>
<body>
    <header>
        <h1>Lining ATSS993</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="products.html">Products</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="cart.html">Shopping Cart</a></li>
            <li><a href="comment_rating.html">Comments and Ratings</a></li>
        </ul>
    </nav>
    <div class="logo-container">
        <a href="index.html">
            <img src="logo.png" alt="Logo">
        </a>
    </div>
    <main>
        <div class="product-detail">
            <img src="Lining ATSS993.png" alt="<?php echo htmlspecialchars($name); ?>">
            <div class="product-info">
                <h1><?php echo htmlspecialchars($name); ?></h1>
                <p class="price">RM<?php echo htmlspecialchars($price); ?></p>
                <p><?php echo htmlspecialchars($description); ?></p>
                <h3>Specifications:</h3>
                <ul>
                    <?php 
                    foreach ($specifications as $spec) {
                        echo "<li>" . htmlspecialchars($spec) . "</li>";
                    }
                    ?>
                </ul>
                <p class="stock">
                    <?php 
                    if ($store > 0) {
                        echo "In Stock: " . htmlspecialchars($store);
                    } else {
                        echo "Out of Stock";
                    }
                    ?>
                </p>
                <div class="purchase-section">
                    <div class="size-selection">
                        <label for="shirt-size">Choose Size:</label>
                        <select id="shirt-size" name="shirt-size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <button <?php echo ($store == 0) ? 'disabled' : ''; ?> onclick="addToCart('<?php echo htmlspecialchars($name); ?>', <?php echo htmlspecialchars($price); ?>, 'Lining ATSS993.png', document.getElementById('shirt-size').value)">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
