<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="forgot_password.css">
    <title>Reset Password</title>
</head>

<body>

<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "pepe_sportshop"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($email!== $_POST["email"]){
        echo "Email does not exist!";
        exit;
    }


    if ($new_password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Update the password in the database
    $sql = "UPDATE manage_members SET password='$new_password' WHERE email='$email'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

    <div class="container" id="container">
        <div class="form-container reset-password">
            <form action="forgot_password.php" method="POST">
                <h1>Reset Password</h1>
                <span>Enter your email and new password</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="new_password" placeholder="New Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Reset Password</button>
                <button type="button" onclick="window.location.href='signin.php'">Return to Sign In</button>
            </form>
        </div>
    </div>

    <script src="sample.js"></script>
</body>

</html>
