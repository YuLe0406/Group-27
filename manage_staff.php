<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="manage_staff.css">
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
    <div class="logo-container">
        <img src="logo.png" alt="Logo">
    </div>
    <main>
        <h2>Staff List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php
            $conn= mysqli_connect("localhost","root","","pepe_sportshop");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT staff_id, name, role FROM manage_staff";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["staff_id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["role"] . "</td>
                            <td>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No staff found</td></tr>";
            }

            $conn->close();
         ?>   
        </table>
        <button>Add New Staff</button>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All right reserved.</p>
    </footer>
</body>
</html>
