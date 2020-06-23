<?php 
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
$resultPlace = $conn->query($sqlPlace) or die($conn->error);
// $rowPlace = $resultPlace->fetch_assoc();


if($resultPlace->num_rows > 0) {
    while($rowPlace = $resultPlace->fetch_assoc()) {
        $place_id =  $rowPlace['id'];
        $ko_title =  mysqli_real_escape_string($conn, $rowPlace['ko_title']);
        $en_title =  mysqli_real_escape_string($conn, $rowPlace['en_title']);
        echo "
        <li class='ko'>
            <div class='place_title'>";
        echo    $ko_title;
        echo "</div>
        </li>
        <li class='en'>
            <div class='place_title'>";
        echo    $en_title;
        echo "</div>
        </li>
        
        ";

    }
}

?>
