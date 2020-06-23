<?php 
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
$resultPlace = $conn->query($sqlPlace) or die($conn->error);
// $rowPlace = $resultPlace->fetch_assoc();

$place_id =  $rowPlace['id'];
$ko_title =  mysqli_real_escape_string($conn, $rowPlace['ko_title']);
$en_title =  mysqli_real_escape_string($conn, $rowPlace['en_title']);

if($resultPlace->num_rows > 0) {
    while($rowPlace = $resultPlace->fetch_assoc()) {
        echo "
        <li class='ko'>
            $ko_title
        </li>
        <li class='en'>
            $en_title
        </li>
        
        ";

    }
}

?>
