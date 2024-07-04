<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET["order_id"])) {
        $orderid = $_GET["order_id"];
        $result = mysqli_query($conn, "SELECT manage_orders.*, customers.name AS customer_name FROM manage_orders LEFT JOIN customers ON manage_orders.customer_id = customers.customer_id WHERE order_id = $orderid");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            die("Error: " . mysqli_error($conn));
        }
    ?>
    <h1>Edit Order</h1>
    <form name="editfrm" method="post" action="">
        <p><label>Order Date:</label><input type="text" name="order_date" size="80" value="<?php echo htmlspecialchars($row['order_date']); ?>"></p>
        <p><label>Customer Name:</label><input type="text" name="customer_name" size="80" value="<?php echo htmlspecialchars($row['customer_name']); ?>"></p>
        <p><label>Total Price:</label><input type="text" name="total_price" size="80" value="<?php echo htmlspecialchars($row['total_price']); ?>"></p>
        <p><input type="hidden" name="order_id" value="<?php echo $orderid; ?>"></p>
        <p><input type="submit" name="savebtn" value="UPDATE ORDER"></p>
    </form>
    <?php
    }

    if (isset($_POST["savebtn"])) {
        $orderid = $_POST["order_id"];
        $order_date = mysqli_real_escape_string($conn, $_POST["order_date"]);
        $customer_name = mysqli_real_escape_string($conn, $_POST["customer_name"]);
        $total_price = mysqli_real_escape_string($conn, $_POST["total_price"]);

        $sql = "UPDATE manage_orders SET order_date='$order_date', customer_id='$customer_id', total_price='$total_price' WHERE order_id=$orderid";
        if (mysqli_query($conn, $sql)) {
            ?>
            <script type="text/javascript">
                alert("Order Updated");
                window.location.href = "manage_orders.php";
            </script>
            <?php
        } else {
            echo "Error updating order: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</div>
</body>
</html>
