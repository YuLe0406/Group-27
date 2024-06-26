<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="sample.css">
    <title>pepe sport shop</title>
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
    if (isset($_POST['sign_up'])) {
        $name = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Simple validation (you can enhance this)
        if (empty($name) || empty($email) || empty($password)) {
            echo "All fields are required!";
            exit;
        }

        // Insert into the database without hashing
        $sql = "INSERT INTO manage_members (name, email, password) VALUES ('$name', '$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['sign_in'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Simple validation (you can enhance this)
        if (empty($email) || empty($password)) {
            echo "All fields are required!";
            exit;
        }

        // Retrieve the user from the database
        $sql = "SELECT * FROM manage_members WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: index.html");
            
        } else {
            echo "Invalid email or password!";
        }
    }

    $conn->close();
}
?>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="signin.php" method="POST">
                <h1>Create Account</h1>
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="sign_up">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="signin.php" method="POST">
                <h1>Sign In</h1>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="forgot_password.php">Forgot Your Password?</a>
                <button type="submit" name="sign_in">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Alreeady a member? Log In Now!</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Not a member? Sign Up Now!</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="sample.js"></script>
</body>

</html>
