<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

$orderQuery = "
    SELECT manage_orders.*, SUM(manage_products.price * order_items.quantity) AS total_price
    FROM manage_orders 
    LEFT JOIN order_items ON manage_orders.order_id = order_items.order_id
    LEFT JOIN manage_products ON order_items.product_id = manage_products.product_id
";


$result = mysqli_query($conn, $orderQuery);
?>

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
                <th>Actions</th>       
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["order_id"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                    <td><?php echo $row["customer_id"]; ?></td>
                    <td><?php echo number_format($row["total_price"], 2); ?></td>
                    <td>
                        <a href='orderedit.php?order_id=<?php echo $row["order_id"]; ?>'><button>Edit</button></a>
                        <a href='manage_orders.php?del&orderid=<?php echo $row["order_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>   

        </table>
        <a href="orderadd.php"><button>Add New Order</button></a>
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
