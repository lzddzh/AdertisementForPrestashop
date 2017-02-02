<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "prestashop";

$email=$_POST['email1'];
$slogan=$_POST['slogan1'];
$name=$_POST['name1'];
$address=$_POST['address1'];
$imgAddr=$_POST['imgAddr1'];
$linkAddr=$_POST['linkAddr1'];
$budget=$_POST['budget1'];
$showAdWhere=$_POST['showAdWhere1'];
$showAdWho=$_POST['showAdWho1'];
$showAdWhen=$_POST['showAdWhen1'];
$AdViewCount=0;
$AdClickCount=0;
$AdViewSeparateCount=0;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "INSERT INTO ps_advertisement (email, slogan, name, address, imgAddr,
linkAddr, budget, showAdWhere, showAdWho, showAdWhen, AdViewCount, AdClickCount,
AdViewSeparateCount)
VALUES ('$email', '$slogan', '$name','$address', '$imgAddr',
'$linkAddr', '$budget', '$showAdWhere', '$showAdWho', '$showAdWhen', '$AdViewCount', '$AdClickCount',
'$AdViewSeparateCount')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
