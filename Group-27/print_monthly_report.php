<?php
if (!isset($_GET['month'])) {
    die("No month specified.");
}

$month = $_GET['month'];

$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "
    SELECT 
        order_id, 
        order_date, 
        customer_id, 
        total_price
    FROM 
        manage_orders
    WHERE 
        DATE_FORMAT(order_date, '%Y-%m') = ?
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $month);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$sales = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sales[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Sales Report - <?php echo htmlspecialchars($month); ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <header>
        <h1>Monthly Sales Report - <?php echo htmlspecialchars($month); ?></h1>
    </header>
    <main>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Customer ID</th>
                <th>Total Price</th>
            </tr>
            <?php if (!empty($sales)): ?>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?php echo htmlspecialchars($sale['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($sale['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($sale['customer_id']); ?></td>
                    <td>RM <?php echo number_format($sale['total_price'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No sales data available for this month</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
    <footer>
        <div class="no-print">
            <p>
                <button onclick="window.print()">Print Report</button>
                <button onclick="window.close()">Close</button>
            </p>
        </div>
    </footer>
</body>
</html>
