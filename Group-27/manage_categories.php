<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

$categoryQuery = "SELECT manage_categories.category_id, manage_categories.name, COUNT(manage_products.product_id) AS total
                  FROM manage_categories
                  LEFT JOIN manage_products ON manage_categories.category_id = manage_products.category_id";

$categoryQuery .= " GROUP BY manage_categories.category_id, manage_categories.name";

$result = mysqli_query($conn, $categoryQuery);	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="manage.css">
</head>

<body>
    <header>
        <h1>Manage Categories</h1>
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
        <h2>Category List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Total</th>
                <th>Actions</th>       
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row["category_id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo number_format($row["total"]); ?></td>
                    <td>
                        <a href='categoryedit.php?edit&catid=<?php echo $row["category_id"]; ?>'><button>Edit</button></a>
                        <a href='manage_categories.php?del&catid=<?php echo $row["category_id"]; ?>' onclick="return confirmation();"><button>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>   
            
        </table>
        <form method="post" action="">
        <button type="submit" name="add">Add New Category</button>
        </form>

    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>

    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this category?");
        }
    </script>
</body>
</html>

<?php
if (isset($_REQUEST["del"])) {
    $catid = $_REQUEST["catid"]; 
    mysqli_query($conn, "DELETE FROM manage_categories WHERE category_id = $catid");
    header("Location: manage_categories.php");
}

if (isset($_POST["add"])) {
    header("Location: categoryadd.php");
}
?>
