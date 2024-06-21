<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pepe_sportshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT manage_categories.category_id, manage_orders.name, manage_orders.total"

$result = $conn->query($sql);

if 