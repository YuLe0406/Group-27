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
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 2;

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
$description = "The Asics Upcourt 5 Sn42 shoes provide exceptional comfort and support for indoor sports. These shoes are designed to offer stability and grip, ensuring peak performance during matches.";
$specifications = [
    "Weight: 270g",
    "Material: Synthetic Leather and Mesh",
    "Color: Black/Red",
    "Size: Available in multiple sizes"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($name); ?> - Product Asics Upcourt 5 Sn42</title>
    <link rel="stylesheet" href="product_detail.css">
    <script src="product_detail_alert.js" defer></script>
    <script src="cart.js"></script>
</head>
<body>
    <header>
        <h1>Asics Upcourt 5 Sn42</h1>
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
            <img src="Asics Upcourt 5 Sn42.jpg" alt="<?php echo htmlspecialchars($name); ?>">
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
                        <label for="shoe-size">Choose Shoe Size:</label>
                        <select id="shoe-size" name="shoe-size">
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <button <?php echo ($store == 0) ? 'disabled' : ''; ?> onclick="addToCart('<?php echo htmlspecialchars($name); ?>', <?php echo htmlspecialchars($price); ?>, 'Asics_Upcourt_5_Sn42.jpg', document.getElementById('shoe-size').value)">
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
