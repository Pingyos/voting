<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "vote"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$token = "131561s3d2f1as4fsad21fsd23f1";
if ($_REQUEST['token'] == $token) {
    $sql = "INSERT INTO user_reg(name, email) VALUES ('" . $_REQUEST['name'] . "','" . $_REQUEST['email'] . "')";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
