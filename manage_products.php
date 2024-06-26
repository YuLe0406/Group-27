<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="manage_products.css">
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
                <th>Name</th>
                <th>Price</th>
                <th>Store</th>
                <th>Actions</th>
            </tr>

            <?php
            $conn= mysqli_connect("localhost","root","","pepe_sportshop");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT product_id, name, price, store FROM manage_products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["product_id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["price"] . "</td>
                            <td>" . $row["store"] . "</td>
                            <td>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No product found</td></tr>";
            }

            $conn->close();
         ?>   
        </table>
        <button>Add New Product</button>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All right reserved.</p>
    </footer>
</body>
</html>
