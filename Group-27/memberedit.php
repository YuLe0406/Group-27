<?php
$conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["memberid"])) {
    $member_id = $_GET["memberid"];
    $result = mysqli_query($conn, "SELECT * FROM manage_members WHERE member_id = $member_id");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Error: " . mysqli_error($conn));
    }
}

if (isset($_POST["savebtn"])) {
    $member_id = $_POST["member_id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE manage_members SET name='$name', email='$email', password='$password_hashed' WHERE member_id=$member_id";
    } else {
        $sql = "UPDATE manage_members SET name='$name', email='$email' WHERE member_id=$member_id";
    }

    if (mysqli_query($conn, $sql)) {
        ?>
        <script type="text/javascript">
            alert("Member Updated");
            window.location.href = "manage_members.php";
        </script>
        <?php
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
    <link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
    <?php if (isset($row)): ?>
    <h1>Edit Member</h1>
    <form name="editfrm" method="post" action="">
        <p><label>Name:</label><input type="text" name="name" size="80" value="<?php echo htmlspecialchars($row['name']); ?>"></p>
        <p><label>Email:</label><input type="email" name="email" size="80" value="<?php echo htmlspecialchars($row['email']); ?>"></p>
        <p><label>Password:</label><input type="password" name="password" size="80"></p>
        <p><small>Leave password blank if you do not want to change it.</small></p>
        <p><input type="hidden" name="member_id" value="<?php echo $member_id; ?>"></p>
        <p><input type="submit" name="savebtn" value="UPDATE MEMBER"></p>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
