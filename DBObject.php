<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practice";


$conn = dbConnect($servername, $username, $password, $dbname);

if($_POST['action'] == 'getAverage') {

    echo returnAverage($totalCount, $noValuesArray);
    closeDBConnection($conn);
    die;
}

$result = getDroneData($conn);

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

closeDBConnection($conn);


function dbConnect($host, $user, $pass, $dbName) {
    // Create connection
    $conn = new mysqli($host, $user, $pass, $dbName);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getDroneData(mysqli $conn) {
    $sql = "SELECT drone, `count` FROM HinckleyDrones";
    return $conn->query($sql);
}

function returnAverage($totalCount, $noValuesArray) {
    $average = $totalCount / $noValuesArray;
    return $average;
}

/**
 * @param $db mysqli
 */
function closeDBConnection(mysqli $db) {
    $db->close();
}