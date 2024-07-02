<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="manage.css">
</head>

<body>
    <header>
        <h1>Manage Orders</h1>
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
        <h2>Order List</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Customer ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>       
            </tr>

            <?php
            $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

            $orderQuery = "
                SELECT o.*, SUM(p.price * oi.quantity) AS total_price
                FROM manage_orders o
                LEFT JOIN order_items oi ON o.order_id = oi.order_id
                LEFT JOIN manage_products p ON oi.product_id = p.product_id
                GROUP BY o.order_id
            ";

            $result = mysqli_query($conn, $orderQuery);

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["order_id"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                    <td><?php echo $row["customer_id"]; ?></td>
                    <td><?php echo number_format($row["total_price"], 2); ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td>
                        <a href='manage_orders.php?del&orderid=<?php echo $row["order_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>   

        </table>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>

    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this order?");
        }
    </script>
</body>
</html>

<?php
if (isset($_REQUEST["del"])) {
    $orderid = $_REQUEST["orderid"];
    mysqli_query($conn, "DELETE FROM manage_orders WHERE order_id = $orderid");
    header("Location: manage_orders.php");
}

mysqli_close($conn);
?>
