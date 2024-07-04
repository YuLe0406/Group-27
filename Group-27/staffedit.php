<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if (isset($_GET["edit"])) {
    $staffid = $_GET["staffid"];
    $result = mysqli_query($conn, "SELECT * FROM manage_staff WHERE staff_id = $staffid");
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["savebtn"])) {
    $staffid = $_POST["staffid"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);

    $sql = "UPDATE manage_staff SET name='$name', role='$role' WHERE staff_id=$staffid";
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_staff.php");
        exit();
    } else {
        echo "Error updating staff: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Edit Staff</h1>
    </header>
    <main>
        <?php if (isset($row)): ?>
        <form method="post" action="">
            <p>
                <label>Name:</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($row['name']); ?>">
            </p>
            <p>
                <label>Role:</label>
                <input type="text" name="role" required value="<?php echo htmlspecialchars($row['role']); ?>">
            </p>
            <input type="hidden" name="staffid" value="<?php echo $staffid; ?>">
            <p><button type="submit" name="savebtn">Update Staff</button></p>
        </form>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>