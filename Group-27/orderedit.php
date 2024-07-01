<html>
<head><title>Edit Category</title>
<link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
 
<div id="wrapper">
 
		<?php
        $conn= mysqli_connect("localhost","root","","pepe_sportshop");

		if(isset($_GET["edit"]))
		{
		 
			$ordid = $_GET["ordid"];
 
			$result = mysqli_query($conn, "SELECT * FROM manage_orders WHERE order_id = $ordid");
			$row = mysqli_fetch_assoc($result);
		?>
		
		<h1>Edit Order</h1>
 
        <form name="editfrm" method="post" action="">   

        <p><label>Category Name:</label><input type="text" name="category_name" size="80" value="<?php echo $row['name']; ?>"></p>

        <p><label>Total:</label><input type="number" name="total" size="80" value="<?php echo $row['total']; ?>"></p>

        <p><input type="submit" name="savebtn" value="UPDATE CATEGORY"></p>
 
		</form>
	    <?php 
		}
		  ?>
	</div>
	
</div>
 
 
</body>
</html>
 
<?php
 
 if (isset($_POST["savebtn"])) {
    $category_name = $_POST["category_name"];
    $total = $_POST["total"];
    
    mysqli_query($conn, "UPDATE manage_categories SET name='$category_name', total=$total WHERE category_id=$catid");
    ?>
    <script type="text/javascript">
        alert("Category Updated");
    </script>
    <?php
    header("refresh:0.5; url=manage_categories.php");
}
 
?>