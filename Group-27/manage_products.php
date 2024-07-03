<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

$search = "";
if (isset($_GET["search"])) {
    $search = mysqli_real_escape_string($conn, $_GET["search"]);
}

$productQuery = "SELECT * FROM manage_products";

if ($search) {
    $productQuery .= " WHERE name LIKE '%$search%' OR category_id LIKE '%$search%'";
}

$result = mysqli_query($conn, $productQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="manage.css">
</head>

<body>
    <header>
        <h1>Manage Products</h1>
    </header>
    <nav>
        <ul>
            <li><a href="admin_dashboard.html">Dashboard</a></li>
            <li><a href="manage_staff.php">Manage Staff</a></li>
            <li><a href="manage_members.php">Manage Members</a></li>
            <li><a href="manage_categories.php">Manage Categories</a></li>
            <li><a href="manage_products.php">Manage Products</a></li>
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="sales_report.php">Sales Report</a></li>
        </ul>
    </nav>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <main>
        <h2>Product List</h2>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search by name or category" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Store</th>
                <th>Category ID</th>
                <th>Actions</th>       
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["product_id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo number_format($row["price"], 2); ?></td>
                    <td><?php echo $row["store"]; ?></td>
                    <td><?php echo $row["category_id"]; ?></td>
                    <td>
                        <a href='productedit.php?product_id=<?php echo $row["product_id"]; ?>'><button>Edit</button></a>
                        <a href='manage_products.php?del&productid=<?php echo $row["product_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>   

        </table>
        <a href="productadd.php"><button>Add New Product</button></a>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>

    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this product?");
        }
    </script>
</body>
</html>

<?php
if (isset($_REQUEST["del"])) {
    $productid = $_REQUEST["productid"];
    $deleteQuery = "DELETE FROM manage_products WHERE product_id = $productid";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: manage_products.php");
    } else {
        echo "<script>alert('Cannot delete product because it is referenced in order items.');</script>";
    }
}

mysqli_close($conn);
?>
