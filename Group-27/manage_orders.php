<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="manage_orders.css">
</head>
<body>
    <header>
        <h1>Manage Orders</h1>
    </header>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
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
                <th>Member ID</th>
                <th>Product ID</th>
                <th>Status</th>
                <th colspan="3">Actions</th>
            </tr>

            
            <?php
            $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
            $result = mysqli_query($conn, "SELECT * FROM manage_orders");	
            
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                        <td><?php echo $row["order_id"]?></td>
                        <td><?php echo $row["member_id"]?></td>
                        <td><?php echo $row["product_id"]?></td>
                        <td><?php echo $row["status"]?></td>
                        <td>
                        <a href='orderedit.php?edit&ordid=<?php echo $row["order_id"]; ?>'><button>Edit</button></a>
                        <a href='orderdelete.php?del&ordid=<?php echo $row["order_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
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
    $ordid = $_REQUEST["ordid"]; 
    mysqli_query($conn, "DELETE FROM manage_orders WHERE order_id = $ordid");
    header("Location: manage_orders.php");
}

