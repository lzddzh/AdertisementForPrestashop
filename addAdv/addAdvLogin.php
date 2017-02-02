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

$email=$_POST['email1']; // Fetching Values from URL.
$password= md5('jo9G3oFdrILxSWuYz0oeftIBk69EK591xqSkg5ZCSYxVJetdu1jfjg6s'.$_POST['password1']); // Password Encryption, If you like you can also leave sha1.
// check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid Email.......";
}else{
$sql = "SELECT * FROM ps_customer WHERE email='$email' AND passwd='$password'";
$result = $conn->query($sql);
$data = $result->num_rows; 
if($data==1){
echo "Successfully Logged in...";
}else{
echo "Email or Password is wrong...!!!!";
}
}

$conn->close();
?>
