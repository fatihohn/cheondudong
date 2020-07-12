<?php 
session_start();
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
// $resultPlace = $conn->query($sqlPlace) or die($conn->error);


// $sqlPlace = "SELECT * FROM places ORDER BY ko_title ASC";
$sqlPlace = "SELECT * FROM places ORDER BY category ASC";
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
        <li id = 'place_";
        echo $place_id;
        echo "' class='ko place_li'>
            <div class='place_title'>";
        echo    $ko_title;
        echo "</div>
        </li>
        <li id = 'place_";
        echo $place_id;
        echo "' class='en place_li'>
            <div class='place_title'>";
        echo    $en_title;
        echo "</div>
        </li>
        
        ";

    }
}

?>

<script>

// function showDetailPlace(str) {
//     location.href = "detail.php?q=" + str;
// }


//     let placeLiAll = document.querySelectorAll(".place_li");
//     if(placeLiAll) {
//         let pl;
//         for(pl=0; pl < placeLiAll.length; pl++) {
//             placeLiAll[pl].showDetailPlace(this.id);
//         }
//     }
</script>
