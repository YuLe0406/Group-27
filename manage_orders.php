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
            <li><a href="admin_dashboard.html">Dashboard</a></li>
            <li><a href="manage_staff.html">Manage Staff</a></li>
            <li><a href="manage_members.html">Manage Members</a></li>
            <li><a href="manage_categories.html">Manage Categories</a></li>
            <li><a href="manage_products.html">Manage Products</a></li>
            <li><a href="manage_orders.html">Manage Orders</a></li>
            <li><a href="sales_report.html">Sales Report</a></li>
        </ul>
    </nav>
    <div class="logo-container">
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
                <th>Actions</th>
            </tr>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "pepe_sportshop";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT order_id, manage_members.name AS member_name, manage_products.name AS product_name, status 
                    FROM manage_orders
                    INNER JOIN manage_members ON manage_orders.member_id = manage_members.member_id
                    INNER JOIN manage_products ON manage_orders.product_id = manage_products.product_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["order_id"] . "</td>
                        <td>" . $row["member_name"] . "</td>
                        <td>" . $row["product_name"] . "</td>
                        <td>" . $row["status"] . "</td>
                        <td>
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found</td></tr>";
        }

        $conn->close();
        ?>
    
        </table>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All right reserved.</p>
    </footer>
</body>
</html>
