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
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 1;

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
$description = "The Astrox 88s Pro is designed for professional badminton players. This racket offers superior control and power, making it ideal for advanced players seeking to dominate the game.";
$specifications = [
    "Weight: 83g",
    "Material: High Modulus Graphite",
    "Flex: Stiff",
    "Balance Point: 305mm",
    "Recommended String Tension: 20-28 lbs"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($name); ?> - Product Detail</title>
    <link rel="stylesheet" href="product_detail.css">
    <script src="cart.js"></script>
</head>
<body>
    <header>
        <h1>Product Detail</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="cart.html">Shopping Cart</a></li>
            <li><a href="comment_rating.html">Comments and Ratings</a></li>
        </ul>
    </nav>
    <div class="logo-container">
        <a href="index.php">
            <img src="logo.png" alt="Logo">
        </a>
    </div>
    <main>
        <div class="product-detail">
            <img src="Astrox 88s pro.jpg" alt="<?php echo htmlspecialchars($name); ?>">
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
                <p class="stock">In Stock: <?php echo htmlspecialchars($store); ?></p>
                <div class="purchase-section">
                    <div class="size-selection">
                        <label for="grip-size">Choose Grip Size:</label>
                        <select id="grip-size" name="grip-size">
                            <option value="G4">G4</option>
                            <option value="G5">G5</option>
                        </select>
                    </div>
                    <button onclick="addToCart('<?php echo htmlspecialchars($name); ?>', <?php echo htmlspecialchars($price); ?>, 'Astrox 88s pro.jpg', document.getElementById('grip-size').value)">Add to Cart</button>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
