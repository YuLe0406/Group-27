<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

$search = "";
if (isset($_GET["search"])) {
    $search= mysqli_real_escape_string($conn, $_GET["search"]);
}

$staffQuery = "SELECT * FROM manage_staff";

if ($search) {
    $staffQuery .= " WHERE name LIKE '%$search%'";
}

$result = mysqli_query($conn, $staffQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="manage.css">
</head>

<body>
    <header>
        <h1>Manage Staff</h1>
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
        <h2>Staff List</h2>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row["staff_id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td>
                        <a href='staffedit.php?edit&staffid=<?php echo $row["staff_id"]; ?>'><button>Edit</button></a>
                        <a href='manage_staff.php?del&staffid=<?php echo $row["staff_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <form method="post" action="">
            <button type="submit" name="add">Add New Staff</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>

    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this staff member?");
        }
    </script>
</body>
</html>

<?php
if (isset($_REQUEST["del"])) {
    $staffid = $_REQUEST["staffid"];
    mysqli_query($conn, "DELETE FROM manage_staff WHERE staff_id = $staffid");
    header("Location: manage_staff.php");
}

if (isset($_POST["add"])) {
    header("Location: staffadd.php");
}

mysqli_close($conn);
?>
