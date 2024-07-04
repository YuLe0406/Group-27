<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["memberid"])) {
    $member_id = (int)$_GET["memberid"];
    $result = mysqli_query($conn, "SELECT * FROM manage_members WHERE member_id = $member_id");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Error: " . mysqli_error($conn));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["savebtn"])) {
    $member_id = (int)$_POST["member_id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if (!empty($password)) {
        $sql = "UPDATE manage_members SET name='$name', email='$email', password='$password' WHERE member_id=$member_id";
    } else {
        $sql = "UPDATE manage_members SET name='$name', email='$email' WHERE member_id=$member_id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_members.php");
        exit();
    } else {
        echo "Error updating member: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
    <header>
        <h1>Edit Member</h1>
    </header>
    <main>
        <?php if (isset($row)): ?>
        <form method="post" action="">
            <p>
                <label>Name:</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($row['name']); ?>">
            </p>
            <p>
                <label>Email:</label>
                <input type="email" name="email" required value="<?php echo htmlspecialchars($row['email']); ?>">
            </p>
            <p>
                <label>Password:</label>
                <input type="password" name="password">
            </p>
            <p><small>Leave password blank if you do not want to change it.</small></p>
            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
            <p><button type="submit" name="savebtn">Update Member</button></p>
        </form>
        <?php endif; ?>
    </main>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <footer>
        <p>&copy; 2024 PEPE Sport Shop. All rights reserved.</p>
    </footer>
</body>
</html>