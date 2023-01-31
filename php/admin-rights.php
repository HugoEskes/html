<?php
require_once 'connection.php';
require_once "session.php";

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Select all users from the 'admins' table
$sql = "SELECT email FROM admins";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Loop through all rows in the 'admins' table
    while ($row = $result->fetch_assoc()) {
        $username = $row["email"];
        $sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON gebruikers.* TO '$username'@'localhost'";
        if ($connection->query($sql) === TRUE) {
            echo "Privileges granted to user $username\n";
        } else {
            echo "Error granting privileges to user $username: " . $connection->error . "\n";
        }
    }
} else {
    echo "No users found in the 'admins' table\n";
}

$connection->close();
?>