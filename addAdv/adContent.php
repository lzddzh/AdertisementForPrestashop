<?php
require_once dirname(__FILE__).'/../config/config.inc.php';
$cookie = new Cookie('ps', '', (int)Configuration::get('PS_COOKIE_LIFETIME_BO'));

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "prestashop";

$where = $_POST['where1'];
$who = $_POST['who1'];
$timeNow = date('H:i');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT email, slogan, name, address, imgAddr, linkAddr, showAdWhen, AdViewCount, 
AdClickCount, AdViewSeparateCount, budget, showAdWhere, showAdWho FROM ps_advertisement 
WHERE showAdWhere LIKE '%{$where}%' AND showAdWho LIKE '%{$who}%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $flag = 0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #echo " Name: " . $row["firstname"]. " " . $row["email"]. $row["passwd"]. "<br>";
        $times = explode("-", $row["showAdWhen"]);
        $start = $times[0];
        $end = $times[1];
        // if $start < $timeNow and $timeNow < $end, then print the item.
        if (strcmp($start, $timeNow) == -1 and strcmp($end, $timeNow) == 1) {
            echo $row["slogan"] . "|" . $row["name"] . "|" . $row["address"] . "|" . $row["imgAddr"] . "|" . $row["linkAddr"] . "|" . $row["AdViewCount"] . "|" . $row["AdClickCount"] . "|". $row["AdViewSeparateCount"]. "|" . $row["budget"]. "|" . $row["showAdWhere"] . "|" . $row["showAdWho"] . "|" . $row["email"];
            $flag = 1;
	}
    }
    if ($flag == 0) {
        echo "0 results";
    }
    if (isset($cookie->id_customer) && $cookie->id_customer) {
    echo '|loginTrue';
} else {
    echo '|loginFalse';
}
} else {
    echo "0 results";
}


$conn->close();
?>
