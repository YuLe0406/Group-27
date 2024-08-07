<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body class="sales-report-page">
    <header>
        <h1>Sales Report</h1>
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
        <h2>Monthly Sales Report</h2>
        <table>
            <tr>
                <th>Month</th>
                <th>Total Sales</th>
                <th>Actions</th>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "
                SELECT DATE_FORMAT(order_date, '%M %Y') AS order_month,
                       SUM(total_price) AS total_sales,
                       DATE_FORMAT(order_date, '%Y-%m') AS month_year
                FROM manage_orders
                GROUP BY DATE_FORMAT(order_date, '%Y-%m')
                ORDER BY DATE_FORMAT(order_date, '%Y-%m') DESC
            ";
            
            $result = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['order_month'] . "</td>";
                    echo "<td>RM" . number_format($row['total_sales'], 2) . "</td>";
                    echo "<td>";
                    echo "<a href='print_monthly_report.php?month=" . $row['month_year'] . "'><button>Print</button></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No sales data available</td></tr>";
            }
            
            mysqli_close($conn);
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
