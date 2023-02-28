<?php
if (!isset($_POST['id']) || !isset($_POST['token'])) {
    die('invalid parameters');
}
// Database credentials
$host = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($host, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if database exists
$dbname = "yourdatabase";
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    // Create database
    $sql = "CREATE DATABASE $dbname";
    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }
} else {
    echo "Database already exists";
}


// Check if table exists
$tablename = "users";
$sql = "SHOW TABLES LIKE '$tablename'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    // Create table
    $sql = "CREATE TABLE $tablename (
        id INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        FullName VARCHAR(60) NOT NULL,
        StudentNo VARCHAR(20) NOT NULL,
        Email VARCHAR(60) NOT NULL,
        Type VARCHAR(10) NOT NULL,
        Status VARCHAR(10) NOT NULL,
        Password VARCHAR(60) NOT NULL,
        registrationID VARCHAR(100) NOT NULL
    )";
    if (mysqli_query($conn, $sql)) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}
Update($conn);
// Close connection
mysqli_close($conn);

function Update($conn)
{
    // Prepare and bind statement
    $stmt = mysqli_prepare($conn, "UPDATE users SET Status = ? WHERE id = ? and registrationId = ?");
    $id = intval($_POST['id']);
    $token = $_POST['token'];
    mysqli_stmt_bind_param($stmt, "sis", "Approved", $id, $token);

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Close statement and connection
    mysqli_stmt_close($stmt);
}
