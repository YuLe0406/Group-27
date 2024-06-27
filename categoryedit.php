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
		 
			$catid = $_GET["catid"];
 
			$result = mysqli_query($conn, "SELECT * from manage_catagories where category_id = $catid");
			$row = mysqli_fetch_assoc($result);
		?>
		
		<h1>Edit Category</h1>
 
		<form name="addfrm" method="post" action="">
 
        <form name="editfrm" method="post" action="">   

        <p><label>Category Name:</label><input type="text" name="category_name" size="80" value="<?php echo $row['category_name']; ?>"></p>

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
    
    mysqli_query($connect, "UPDATE manage_categories SET category_name='$category_name', total=$total WHERE category_id=$catid");
    ?>
    <script type="text/javascript">
        alert("Category Updated");
    </script>
    <?php
    header("refresh:0.5; url=category_list.php");
}
 
?>