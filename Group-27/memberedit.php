<html>
<head><title>Edit Member</title>
<link href="design.css" type="text/css" rel="stylesheet" />
</head>
<body>
 
<div id="wrapper">
 
		<?php
        $conn= mysqli_connect("localhost","root","","pepe_sportshop");

		if(isset($_GET["edit"]))
		{
		 
			$memid = $_GET["memid"];
 
			$result = mysqli_query($conn, "SELECT * FROM manage_members WHERE member_id = $memid");
			$row = mysqli_fetch_assoc($result);
		?>
		
		<h1>Edit Member</h1>
 
		<form name="addfrm" method="post" action="">
 
        <form name="editfrm" method="post" action="">   
        <p><label>Member Name:</label><input type="text" name="member_name" size="80" value="<?php echo $row['name']; ?>"></p>

        <p><label>Email:</label><input type="email" name="email" size="80" value="<?php echo $row['email']; ?>"></p>

        <p><label>Password:</label><input type="password" name="password" size="80" value="<?php echo $row['password']; ?>"></p>

        <p><input type="submit" name="savebtn" value="UPDATE MEMBER"></p>
 
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
    $member_name = $_POST["member_name"];
    $total = $_POST["total"];
    
    mysqli_query($conn, "UPDATE manage_members SET name='$member_name', email='$email', password='password' WHERE member_id=$memid");
    ?>
    <script type="text/javascript">
        alert("Member Updated");
    </script>
    <?php
    header("refresh:0.5; url=manage_members.php");
}
 
?>