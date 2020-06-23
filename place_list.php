<?php 
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
// $resultPlace = $conn->query($sqlPlace) or die($conn->error);


$sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
// $resultPlace = $conn->query($sqlPlace) or die($conn->error);

$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPlace)) {
            // echo "sqlPlace error";
    } else {
            // mysqli_stmt_bind_param($stmt, "s", $author);
            mysqli_stmt_execute($stmt);
            $resultPlace = mysqli_stmt_get_result($stmt);
    }




if($resultPlace->num_rows > 0) {
    while($rowPlace = $resultPlace->fetch_assoc()) {
        $place_id =  $rowPlace['id'];
        $ko_title =  $rowPlace['ko_title'];
        $en_title =  $rowPlace['en_title'];
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
