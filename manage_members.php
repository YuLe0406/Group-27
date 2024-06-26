<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Members</title>
    <link rel="stylesheet" href="manage_members.css">
</head>
<body>
    <header>
        <h1>Manage Members</h1>
    </header>
    <nav>
        <ul>
            <li><a href="admin_dashboard.html">Dashboard</a></li>
            <li><a href="manage_staff.html">Manage Staff</a></li>
            <li><a href="manage_members.html">Manage Members</a></li>
            <li><a href="manage_categories.html">Manage Categories</a></li>
            <li><a href="manage_products.html">Manage Products</a></li>
            <li><a href="manage_orders.html">Manage Orders</a></li>
            <li><a href="sales_report.html">Sales Report</a></li>
        </ul>
    </nav>
    <div class="logo-container">
        <img src="logo.png" alt="Logo">
    </div>
    <main>
        <h2>Member List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <?php
            $conn= mysqli_connect("localhost","root","","pepe_sportshop");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT member_id, name, email, password FROM manage_members";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["member_id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . '*****', strlen($row["password"]) . "</td>
                            <td>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No product found</td></tr>";
            }

            $conn->close();
         ?>   
        </table>
        <button>Add New Member</button>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All right reserved.</p>
    </footer>
    
</body>
</html>
