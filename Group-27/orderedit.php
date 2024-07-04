<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["order_id"])) {
    $orderid = $_GET["order_id"];
    $result = mysqli_query($conn, "SELECT manage_orders.*, manage_members.name AS customer_name FROM manage_orders LEFT JOIN manage_members ON manage_orders.customer_id = manage_members.member_id WHERE order_id = $orderid");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Error: " . mysqli_error($conn));
    }
}

if (isset($_POST["savebtn"])) {
    $orderid = $_POST["order_id"];
    $order_date = mysqli_real_escape_string($conn, $_POST["order_date"]);
    $customer_name = mysqli_real_escape_string($conn, $_POST["customer_name"]);
    $total_price = mysqli_real_escape_string($conn, $_POST["total_price"]);
    $customerResult = mysqli_query($conn, "SELECT member_id FROM manage_members WHERE name = '$customer_name'");
    $customerRow = mysqli_fetch_assoc($customerResult);
    $customer_id = $customerRow['member_id'];

    $sql = "UPDATE manage_orders SET order_date='$order_date', customer_id='$customer_id', total_price='$total_price' WHERE order_id=$orderid";
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Edit Order</h1>
    </header>
    <main>
        <?php if (isset($row)): ?>
        <form method="post" action="">
            <p>
                <label>Order Date:</label>
                <input type="text" name="order_date" required value="<?php echo htmlspecialchars($row['order_date']); ?>">
            </p>
            <p>
                <label>Customer Name:</label>
                <input type="text" name="customer_name" required value="<?php echo htmlspecialchars($row['customer_name']); ?>">
            </p>
            <p>
                <label>Total Price:</label>
                <input type="text" name="total_price" required value="<?php echo htmlspecialchars($row['total_price']); ?>">
            </p>
            <input type="hidden" name="order_id" value="<?php echo $orderid; ?>">
            <p><button type="submit" name="savebtn">Update Order</button></p>
        </form>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>