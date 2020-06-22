<?php 
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlIntro = "SELECT * FROM intro ORDER BY id DESC LIMIT 1";
$resultIntro = $conn->query($sqlIntro) or die($conn->error);
$rowIntro = $resultIntro->fetch_assoc();

$ko_cont =  $rowIntro['ko_cont'];

$en_cont =  $rowIntro['en_cont'];

?>

<p class="ko">
    <?php echo $ko_cont; ?>
</p>
<p class="en">
    <?php echo $en_cont; ?>
</p>