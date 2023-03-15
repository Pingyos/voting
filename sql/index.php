<?php
$servername = "localhost"; // Replace with your server name
$username = "edonation"; // Replace with your database username
$password = "edonate@FON"; // Replace with your database password
$dbname = "vote"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$token = "131561s3d2f1as4fsad21fsd23f1";

if (isset($_REQUEST['token']) && $_REQUEST['token'] == $token) {
    $Email = $_REQUEST['Email'];

    $stmt = $conn->prepare("INSERT INTO user_reg ( Email) VALUES ('".$_REQUEST['Email']."')");
    $stmt->bind_param("s", $Email);

    if ($stmt->execute()) {
        echo "Saved successfully";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}


// Close connection
$conn->close();
