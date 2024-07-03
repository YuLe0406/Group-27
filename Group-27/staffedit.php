<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff</title>
    <link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
 
<div id="wrapper">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

    if (isset($_GET["edit"])) {
        $staffid = $_GET["staffid"];
        $result = mysqli_query($conn, "SELECT * FROM manage_staff WHERE staff_id = $staffid");
        $row = mysqli_fetch_assoc($result);
    ?>
        <h1>Edit Staff</h1>
 
        <form name="editfrm" method="post" action="">
            <p><label>Name:</label><input type="text" name="name" size="80" value="<?php echo $row['name']; ?>"></p>
            <p><label>Role:</label><input type="text" name="role" size="80" value="<?php echo $row['role']; ?>"></p>
            <p><input type="submit" name="savebtn" value="UPDATE STAFF"></p>
        </form>
        
    <?php 
    }
    ?>
</div>

</body>
</html>
 
<?php
if (isset($_POST["savebtn"])) {
    $name = $_POST["name"];
    $role = $_POST["role"];
    
    mysqli_query($conn, "UPDATE manage_staff SET name='$name', role='$role' WHERE staff_id=$staffid");
    ?>
    <script type="text/javascript">
        alert("Staff Updated");
    </script>
    <?php
    header("refresh:0.5; url=manage_staff.php");
}
?>
