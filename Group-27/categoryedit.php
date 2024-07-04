<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
<div id="wrapper">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "pepe_sportshop");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET["edit"])) {
        $catid = $_GET["catid"];
        $result = mysqli_query($conn, "SELECT * FROM manage_categories WHERE category_id = $catid");

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            die("Error: " . mysqli_error($conn));
        }
    ?>
    <h1>Edit Category</h1>
    <form name="editfrm" method="post" action="">
        <p><label>Category Name:</label><input type="text" name="category_name" size="80" value="<?php echo htmlspecialchars($row['name']); ?>"></p>
        <p><input type="hidden" name="catid" value="<?php echo $catid; ?>"></p>
        <p><input type="submit" name="savebtn" value="UPDATE CATEGORY"></p>
    </form>
    <?php
    }

    if (isset($_POST["savebtn"])) {
        $catid = $_POST["catid"];
        $category_name = mysqli_real_escape_string($conn, $_POST["category_name"]);

        $sql = "UPDATE manage_categories SET name='$category_name' WHERE category_id=$catid";
        if (mysqli_query($conn, $sql)) {
            ?>
            <script type="text/javascript">
                alert("Category Updated");
                window.location.href = "manage_categories.php";
            </script>
            <?php
        } else {
            echo "Error updating category: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</div>
</body>
</html>
