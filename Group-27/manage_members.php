<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

$memberQuery = "SELECT * FROM manage_members";
$result = mysqli_query($conn, $memberQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Members</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Manage Members</h1>
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
        <h2>Member List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row["member_id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                        <a href='memberedit.php?edit&memberid=<?php echo $row["member_id"]; ?>'><button>Edit</button></a>
                        <a href='manage_members.php?del&memberid=<?php echo $row["member_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <form method="post" action="">
        <button type="submit" name="add">Add New Member</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>

    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this member?");
        }
    </script>
</body>
</html>

<?php
if (isset($_REQUEST["del"])) {
    $memberid = $_REQUEST["memberid"];
    mysqli_query($conn, "DELETE FROM manage_members WHERE member_id = $memberid");
    header("Location: manage_members.php");
    exit();
}

if (isset($_POST["add"])) {
    header("Location: memberadd.php");
}


mysqli_free_result($result);
mysqli_close($conn);
?>
