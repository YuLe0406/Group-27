<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pepe_sportshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get order details along with member ID and product ID
$sql = "SELECT manage_orders.order_id, manage_orders.product_id, manage_orders.status, manage_members.member_id
        FROM manage_orders
        INNER JOIN manage_members ON manage_orders.member_id = manage_members.member_id
        INNER JOIN manage_products ON manage_orders.product_id = manage_products.product_id";
        
$result = $conn->query($sql);