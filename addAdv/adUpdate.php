<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "prestashop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$command = $_POST['command1'];
$email = $_POST['email1'];

if ($command == 'delete') {
    // sql to delete a record
    $sql = "DELETE FROM ps_advertisement WHERE email='$email'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else if ($command == 'updateViewCount') {
    $sql = "UPDATE ps_advertisement SET AdViewCount = AdViewCount +1 WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else if ($command == 'updateClickCount') {
    $sql = "UPDATE ps_advertisement SET AdClickCount = AdClickCount +1 WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }   
}

$conn->close();
?>
