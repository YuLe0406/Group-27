<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $total_price = $_POST["total_price"];
    $order_date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO manage_orders (order_date, customer_id, total_price) VALUES ('$order_date', '$customer_id', '$total_price')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$customers = mysqli_query($conn, "SELECT member_id, name FROM manage_members");

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Order</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Add New Order</h1>
    </header>
    <main>
        <form method="post" action="">
            <p>
                <label>Customer:</label>
                <select name="customer_id" required>
                    <?php while ($row = mysqli_fetch_assoc($customers)) { ?>
                        <option value="<?php echo $row['member_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label>Total Price:</label>
                <input type="number" step="0.01" name="total_price" required>
            </p>
            <p><button type="submit" name="add_order">Add Order</button></p>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>
