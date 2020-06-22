<?php 
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
$resultPlace = $conn->query($sqlPlace) or die($conn->error);
$rowPlace = $resultPlace->fetch_assoc();

$ko_title =  $rowPlace['ko_title'];
$en_title =  $rowPlace['en_title'];

?>

<p class="ko">
    <?php echo $ko_title; ?>
    테스트 장소
</p>
<p class="en">
    <?php echo $en_title; ?>
    TEST PLACE
</p>