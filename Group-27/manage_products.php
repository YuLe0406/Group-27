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
        <table>
            <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>Name</th>
                <th>Price</th>
                <th>Store</th>
                <th>Category</th>
                <th>Actions</th>       
            </tr>

            <?php
            $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $result = mysqli_query($conn, "SELECT p.*, c.name as category_name FROM manage_products p LEFT JOIN manage_categories c ON p.category_id = c.category_id");	
            
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row["product_id"]; ?></td>
                    <td>
                        <?php 
                        if (!empty($row["picture"])) {
                            echo '<img src="uploads/' . $row["picture"] . '" alt="Product Image" width="100">';
                        } else {
                            echo 'No Image';
                        }
                        ?>
                    </td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["store"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td>
                        <a href='productedit.php?edit&prodid=<?php echo $row["product_id"]; ?>'><button>Edit</button></a>
                        <a href='manage_products.php?del&prodid=<?php echo $row["product_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            mysqli_close($conn);
            ?>   
        </table>
        <form method="post" action="">
            <button type="submit" name="add">Add New Product</button>
        </form>
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
    $prodid = $_REQUEST["prodid"];
    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_query($conn, "DELETE FROM manage_products WHERE product_id = $prodid");
    mysqli_close($conn);
    header("Location: manage_products.php");
}

if (isset($_POST["add"])) {
    header("Location: productadd.php");
}
?>