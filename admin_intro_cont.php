<?php 
session_start();
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlIntro = "SELECT * FROM intro ORDER BY id DESC LIMIT 1";
$resultIntro = $conn->query($sqlIntro) or die($conn->error);
$rowIntro = $resultIntro->fetch_assoc();

$ko_cont =  $rowIntro['ko_cont'];
$en_cont =  $rowIntro['en_cont'];
$intro_id =  $rowIntro['id'];

?>

<?php
    // echo "<p class='ko'>";
    // echo    $ko_cont; 
    // echo "</p>";
    // echo "<p class='en'>";
    // echo    $en_cont;
    // echo "</p>";
     ?>

     <div class="ko">
        <?=$ko_cont?>
     </div>
     <div class="en">
        <?=$en_cont?>
     </div>

      <div id="del_intro" class="<?php echo $intro_id; ?>"  onclick="introDel(this.className)">
         <a>
            <img src="static/img/del_btn.png" alt="삭제" title="삭제하기">
         </a>
      </div>