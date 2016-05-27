<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practice";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT drone, count FROM HinckleyDrones";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " - Drone: " . $row["drone"]. "<br>" . "- Count: " . $row["count"]. "<br>" . "<br>";
	$count[] = $row["count"];
    }
} else {
    echo "0 results";
}

$totalCount = array_sum($count);
$noValuesArray = count($count);

if($_POST['action'] == 'getAverage') {
    echo returnAverage();
    die;
}

function returnAverage() {
    $average = $totalCount / $noValuesArray;
    return $average;
}

$conn->close();
?>