<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

$query = "
    SELECT 
        manage_orders.order_id,
        manage_orders.order_date,
        manage_orders.customer_id,
        SUM(order_items.quantity * manage_products.price) AS total_sale
    FROM manage_orders
    JOIN order_items ON manage_orders.order_id = order_items.order_id
    JOIN manage_products ON order_items.product_id = manage_products.product_id
    WHERE DATE_FORMAT(manage_orders.order_date, '%Y-%m') = ?
    AND manage_orders.status IN ('Approved', 'Pending')
    GROUP BY manage_orders.order_id
    ORDER BY manage_orders.order_date ASC
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $month);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$total_monthly_sales = 0;
$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
    $total_monthly_sales += $row['total_sale'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Sales Report - <?php echo date('F Y', strtotime($month)); ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h1>Monthly Sales Report - <?php echo date('F Y', strtotime($month)); ?></h1>
    
    <table>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Customer ID</th>
            <th>Total Sale</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
            <td><?php echo $order['customer_id']; ?></td>
            <td>RM <?php echo number_format($order['total_sale'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="total">
            <td colspan="3">Total Monthly Sales</td>
            <td>RM <?php echo number_format($total_monthly_sales, 2); ?></td>
        </tr>
    </table>

    <div class="no-print">
        <p>
            <button onclick="window.print()">Print Report</button>
            <button onclick="window.close()">Close</button>
        </p>
    </div>
</body>
</html>